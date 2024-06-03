<?php

namespace App\Manager;
use Illuminate\Http\Request;

interface EtudiantManagerInterface{

    public function getAll($key = null, $value = null, $useMasterKey = false);
    public function store(Request $request);
    public function getbyId($id_produit);
    public function update($id_produit, Request $request);
    public function searchEtudiant($keywords);
    public function destroy($produits, $useMasterKey = false);
}
