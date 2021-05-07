<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class MouvementComptable extends Model
{
    protected $fillable = [
        'user_id','num_piece', 'ref_piece', 'montant_debit','montant_credit','tva'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
