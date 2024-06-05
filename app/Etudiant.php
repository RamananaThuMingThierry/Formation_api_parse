<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    public $table = "etudiant";

    public $fillable = [
        'nom',
        'prenom',
        'genre'
    ];
}
