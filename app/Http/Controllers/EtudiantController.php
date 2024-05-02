<?php

namespace App\Http\Controllers;

use App\ParseRequest;
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseException;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    // Méthode permettant de récupérer la des étudiants
    public function index(){
        $query = new ParseQuery("etudiant");

        try {

            $etudiant = $query->find(false, false);

            return response()->json([
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

    // Méthode permettant d'ajout un nouveau étudiant
    public function store(Request $request){
        
        $nom = $request->nom;
        $prenom = $request->prenom;
        $promotion = $request->promotion;
        $genre = $request->genre;

        if(ParseRequest::checkHealth()){

            $etudiant = new ParseObject("etudiant");
            $etudiant->set("nom", $nom);
            $etudiant->set("prenom", $prenom);
            $etudiant->set("promotion", $promotion);
            $etudiant->set("genre", $genre);

            $etudiant->save();
          
            try {
                $etudiant->save();

                return response()->json([
                    'message' => 'Enregistrement réussi'
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

    // Méthode permettant de récupérer un étudiant
    public function show($id_etudiant){
        
        $query = new ParseQuery("etudiant");

        try {

            $etudiant = $query->get($id_etudiant, false);

            $nom = $etudiant->get("nom");
            $prenom = $etudiant->get("prenom");
            $promotion = $etudiant->get("promotion");
            $genre = $etudiant->get("genre");

            return response()->json([
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

    public function update(Request $request, $id_etudiant){
        $query = new ParseQuery("etudiant");

        try {

            $etudiant = $query->get($id_etudiant, false);

            $nom = $etudiant->get("nom");
            $prenom = $etudiant->get("prenom");
            $promotion = $etudiant->get("promotion");
            $genre = $etudiant->get("genre");

            return response()->json([
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

    public function delete($id_etudiant){

    }
}
