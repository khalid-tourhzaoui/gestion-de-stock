<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $table="commandes";
    protected $primaryKey="id_commande";
    protected $fillable=["id_commande","id","date_commande","quantite_commande","prix_commande","status"];
    public function user(){
        return $this->belongsTo(User::class,"id","id");
    }
    public function livraison(){
        return $this->belongsTo(User::class,"id_commande","id_commande");
    }
}
