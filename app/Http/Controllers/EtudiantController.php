<?php

namespace App\Http\Controllers;

use App\Etudiant;
use App\ParseRequest;
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseException;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\EtudiantRequest;
use App\Manager\EtudiantManagerInterface;
use Illuminate\Support\Facades\Redirect;

class EtudiantController extends Controller
{
    // Méthode permettant de récupérer la des étudiants
    public function index(EtudiantManagerInterface $etudiantManagerInterface){
        try {

            $etudiants = $etudiantManagerInterface->getAll();

            foreach ($etudiants as $etudiant) {
                $etudiant->set('objectId', Crypt::encryptString($etudiant->getObjectId()));
            }

           return view('admin.etudiant.index', compact('etudiants'));

        } catch (ParseException $ex) {
        
            return response()->json([
                'message' => 'Échec de la création d\'un nouvel objet, avec un message d\'erreur:' . $ex->getMessage()
            ]);
        }
    }

    public function create(){
        $etudiant = new Etudiant();
        
        // Pré-remplire un champs
        $etudiant->fill([
            'nom' => 'RAMANANA',
            'prenom' => 'Thierry'
        ]);

        return View('admin.etudiant.form',[
            'etudiant' => $etudiant,
            'autorisation' => false
        ]);
    }

    // Méthode permettant d'ajout un nouveau étudiant
    public function store(EtudiantRequest $request){
       
        $nom = $request->nom;
        $prenom = $request->prenom;
        $genre = $request->genre;

        if(ParseRequest::checkHealth()){

            $etudiant = new ParseObject("etudiant");
            $etudiant->set("nom", $nom);
            $etudiant->set("prenom", $prenom);
            $etudiant->set("genre", $genre);
            
            try {
                $etudiant->save();

                return Redirect(route('admin.etudiant.index'));

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
    public function show($id_etudiant, EtudiantManagerInterface $etudiantManagerInterface){
       
        $etudiant = $etudiantManagerInterface->getbyId(Crypt::decryptString($id_etudiant));
       
        return View('admin.etudiant.show', compact('etudiant'));
    }

    public function edit($id_etudiant, EtudiantManagerInterface $etudiantManagerInterface){
        return View('admin.etudiant.form', [
            'etudiant' =>  $etudiantManagerInterface->getbyId(Crypt::decryptString($id_etudiant)),
            'autorisation' => true,
            'id_etudiant' => $id_etudiant
        ]);    
    }

    public function update(EtudiantRequest $request, $id_etudiant, EtudiantManagerInterface $etudiantManagerInterface){
        
        try {

            $nom = $request->nom;
            $prenom = $request->prenom;
            $genre = $request->genre;

            $etudiant= $etudiantManagerInterface->getbyId(Crypt::decryptString($id_etudiant));
            
            $etudiant->set("nom", $nom);
            $etudiant->set("prenom", $prenom);
            $etudiant->set("genre", $genre);

            $etudiant->save();

            return Redirect(route('admin.etudiant.index')); 
        } catch (ParseException $ex) {
            return response()->json([
                'message' => 'Échec de la création d\'un nouvel objet, avec un message d\'erreur:' . $ex->getMessage()
            ]);
        }
    }

    public function delete($id_etudiant, EtudiantManagerInterface $etudiantManagerInterface){

        try {

            $etudiant= $etudiantManagerInterface->getbyId(Crypt::decryptString($id_etudiant));

            $etudiant->destroy();

            return Redirect(route('admin.etudiant.index')); 

        } catch (ParseException $ex) {
            return response()->json([
                'message' => 'Échec de la création d\'un nouvel objet, avec un message d\'erreur:' . $ex->getMessage()
            ]);
        }
    }
}
