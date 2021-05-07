<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bilan extends Model
{
    protected $fillable = [
        'code_compte', 'nom_compte', 'montant_actif','montant_passif','actif','passif',
    ];
    

}
