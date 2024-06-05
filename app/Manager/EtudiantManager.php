<?php 
  
namespace App\Manager;

use App\ParseRequest;
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseException;
use Illuminate\Http\Request;
use App\Manager\EtudiantManagerInterface;

class EtudiantManager implements EtudiantManagerInterface{
  
  private $className = "etudiant";

  public function getAll($key = null, $value = null, $useMasterKey = false){
    $parseRequest = new ParseRequest();

    if($parseRequest->InitParseRequest()){
        $query = new ParseQuery($this->className);

        if ($key != null && $value != null) {
            $query->equalTo($key, $value);
        }

        try {
            
            $etudiants = $query->find($useMasterKey);

        } catch (ParseException $e) {
            Request()->session()->flash('error_message', $e->getMessage());
        }
        return $etudiants;
    }
  }

  public function store(Request $request){
        
        $parseRequest = new ParseRequest();

        if($parseRequest->InitParseRequest()){

            $etudiant = new ParseObject($this->className);

            $etudiant->set('nom', $request->nom);
            $etudiant->set('prenom', $request->prenom);
            $etudiant->set('genre', $request->genre);

            try {
                return $etudiant->save();
            } catch (ParseException $e) {
                die($e->getMessage());
            }
        }
  }

  public function getbyId($id_etudiant){
    $parseRequest = new ParseRequest();

    if($parseRequest->InitParseRequest()){
        $query = new ParseQuery($this->className);

        try {
            $etudiant = $query->get($id_etudiant);
        } catch (ParseException $e) {
            Request()->session()->flash('error_message', $e->getMessage());
        }
        return $etudiant;
    }
  }
  
  public function update($id_etudiant, Request $request){
    $parseRequest = new ParseRequest();

    if($parseRequest->InitParseRequest()){

        $etudiant = $this->getbyId($id_etudiant);

        $etudiant->set('nom', $request->nom);
        $etudiant->set('prenom', $request->prenom);
        $etudiant->set('genre', $request->genre);

        try {
            $etudiant->save();
        } catch (ParseException $e) {
            Request()->session()->flash('error_message', $e->getMessage());
        }
    }
  }

  public function searchEtudiant($keywords){
    $parseRequest = new ParseRequest();

    if($parseRequest->InitParseRequest()){
        $query = new ParseQuery($this->className);
        $query->fullText('nom', $keywords);

        try {
            $etudiants = $query->find();
        } catch (ParseException $e) {
            Request()->session()->flash('error_message', $e->getMessage());
        }

        return $etudiants;
    }
  }

  public function destroy($etudiant, $useMasterKey = false){
        $parseRequest = new ParseRequest();
        if ($parseRequest->InitParseRequest()) {

            try {
                if (is_array($etudiant)) {
                    ParseObject::destroyAll($etudiant, $useMasterKey);
                } else {
                    $etudiant->destroy($useMasterKey);
                }
            } catch (ParseException $e) {
                return json_encode([
                    'error'             =>  true,
                    'error_message'     =>  $e->getMessage()
                ]);
            }

            return json_encode([
                'error'     =>  false,
                'success'   =>  true,
                'code'      =>  "204"
            ]);
        }
    }
}