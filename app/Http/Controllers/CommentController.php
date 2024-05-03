<?php

namespace App\Http\Controllers;

use App\ParseRequest;
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseException;
use Illuminate\Http\Request;

class CommentController extends Controller
{
     // Méthode permettant de récupérer la des étudiants
     public function index(){
        $query = new ParseQuery("Comment");

        try {

            // Utiliser API
            //$etudiants = $query->find(false, false);
            $comments = $query->find(false, false);
            
            //return view('etudiant.index', compact('posts'));

            return response()->json([
                'comments' => $comments
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
    public function store(Request $request, $id_post){
        
        $content = $request->content;

        if(ParseRequest::checkHealth()){

            $post = new ParseObject("Post", $id_post);
            $comments = new ParseObject("Comment");
            
            $comments->set("content", "Combien ça coûtes?");
            $comments->set("parent", $post);
          
            try {

                $comments->save();
                return response()->json([
                    'message' => 'Enregistrement réussi avec Id : ' .$comments->getObjectId()
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
}
