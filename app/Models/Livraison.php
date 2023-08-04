<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;
    protected $table="livraisons";
    protected $primaryKey="id_livraison";
    protected $fillable = ['id_livraison','id_commande','id','adresse','date_livraison','etat'];
    public function user(){
        return $this->belongsTo(User::class,"id","id");
    }
    public function commande(){
        return $this->hasOne(Commande::class,"id_commande","id_commande");
    }
}
