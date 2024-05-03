<?php

namespace App\Http\Controllers;

use App\ParseRequest;
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseException;
use Illuminate\Http\Request;

class PostController extends Controller
{
     // Méthode permettant de récupérer la des étudiants
     public function index(){
        $query = new ParseQuery("Post");

        try {

            // Utiliser API
            //$etudiants = $query->find(false, false);
            $posts = $query->find();            
            //return view('etudiant.index', compact('posts'));
             // Parcourir les publications
            foreach ($posts as $post) {
            //     // Récupérer les commentaires associés à cette publication
                $commentsQuery = new ParseQuery("Comment");
                $commentsQuery->equalTo("parent", $post->getObjectId());
                $comments = $commentsQuery->find();
            //     // Stocker les commentaires dans un tableau associatif avec l'ID de la publication comme clé
                $commentsByPostId[$post->getObjectId()] = $comments;
            }

            return view('etudiant.index', compact('posts', 'commentsByPostId'));
            

            // L'objet a été récupéré avec succès.
        } catch (ParseException $ex) {
            // The object was not retrieved successfully.
            // error is a ParseException with an error code and message.
            return response()->json([
                'message' => 'Échec de la création d\'un nouvel objet, avec un message d\'erreur:' . $ex->getMessage()
            ]);
        }
    }

    // Méthode permettant d'ajout un nouveau étudiant
    public function store(Request $request){
        
        $title = $request->title;
        $content = $request->content;

        if(ParseRequest::checkHealth()){

            $post = new ParseObject("Post");
            $post->set("title", $title);
            $post->set("content", $content);
          
            try {

                $post->save();
                return response()->json([
                    'message' => 'Enregistrement réussi avec Id : ' .$post->getObjectId()
                ]);

            } catch (ParseException $ex) {  
                // Exécuter toute logique à mettre en œuvre en cas d'échec de la sauvegarde.
                // L'erreur est un objet ParseException avec un code d'erreur et un message.
                return response()->json([
                    'message' => 'Échec de la création d\'un nouvel objet, avec un message d\'erreur:' . $ex->getMessage()
                ]);
            }
        }
    }

    // Méthode permettant de faire une recherche d'un ou des étudiant(s)
    public function search($nomEtudiant){
        try {
            // Créer une instance de la classe ParseQuery pour la classe spécifique que vous souhaitez interroger
            $queryNom = new ParseQuery("etudiant");
            $queryPrenom = new ParseQuery("etudiant");
            // Créer une condition pour le champ "nom"
            $queryNom->matches("nom", $nomEtudiant, 'i');

            // Créer une condition pour le champ "prenom"
            $queryPrenom->matches("prenom", $nomEtudiant, 'i');

            // Fusionner les résultats des deux requêtes en un seul tableau
            $query = ParseQuery::orQueries([$queryNom, $queryPrenom]);

        
            // Exécuter la requête pour récupérer les objets correspondants
            $results = $query->find(false, false);
            
            return response()->json([
                'etudiants' => $results
            ]);

        } catch (ParseException $ex) {
            // Gérer les erreurs de requête
            echo 'Failed to retrieve objects, with error message: ' . $ex->getMessage();
        }
    }

    // Méthode permettant de récupérer un étudiant
    public function show($id_etudiant){
        
        $query = new ParseQuery("etudiant");

        try {

            $etudiant = $query->get($id_etudiant, false);

            $nom = $etudiant->get("nom");
            $prenom = $etudiant->get("prenom");
            $promotion = $etudiant->get("promotion");
            $genre = $etudiant->get("genre");
            $objectId = $etudiant->getObjectId();
            $updatedAt = $etudiant->getUpdatedAt();
            $createdAt = $etudiant->getCreatedAt();
            $acl = $etudiant->getACL();

            return response()->json([
                'updatedAt' => $updatedAt,
                'createdAt' => $createdAt,
                'acl' => $acl,
                'id' => $objectId,
                'nom' => $nom,
                'prenom' => $prenom,
                'promotion' => $promotion,
                'genre' => $genre,
                'etudiant' => $etudiant
            ], 200);

            // L'objet a été récupéré avec succès.
        } catch (ParseException $ex) {
            // The object was not retrieved successfully.
            // error is a ParseException with an error code and message.
            return response()->json([
                'message' => 'Échec de la création d\'un nouvel objet, avec un message d\'erreur:' . $ex->getMessage()
            ]);
        }
    }

    // Méthode permettant de faire une mise à jours des données d'un étudiant
    public function update(Request $request, $id_etudiant){
 
        $query = new ParseQuery("etudiant");
        
        try {

            $etudiant = $query->get($id_etudiant, false);

            $nom = $request->nom;
            $prenom = $request->prenom;
            $promotion = $request->promotion;
            $genre = $request->genre;

            // $etudiant->set("nom", $nom);
            // $etudiant->set("prenom", $prenom);
            // $etudiant->set("promotion", $promotion);
            // $etudiant->set("genre", $genre);
            $etudiant->increment("score");
            $etudiant->addUnique("skills", ["B", "T", "K"]);
            $etudiant->save();

            return response()->json([
                'message' => 'Modification réuissi!'
            ], 200);

            // L'objet a été récupéré avec succès.
        } catch (ParseException $ex) {
            // The object was not retrieved successfully.
            // error is a ParseException with an error code and message.
            return response()->json([
                'message' => 'Échec de la création d\'un nouvel objet, avec un message d\'erreur:' . $ex->getMessage()
            ]);
        }
    }

    public function delete($id_etudiant){
        $query = new ParseQuery("etudiant");

        try {

            $etudiant = $query->get($id_etudiant, false);

            $etudiant->destroy();

            return response()->json([
                'message' => 'Suppression réuissi!'
            ], 200);

            // L'objet a été récupéré avec succès.
        } catch (ParseException $ex) {
            // The object was not retrieved successfully.
            // error is a ParseException with an error code and message.
            return response()->json([
                'message' => 'Échec de la création d\'un nouvel objet, avec un message d\'erreur:' . $ex->getMessage()
            ]);
        }
    }
}
