<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $table="paiements";
    protected $primaryKey="id_paiement";
    protected $fillable=["id_paiement","id","prix_paiement","date_paiement"];
    public function user(){
        return $this->belongsTo(User::class,"id","id");
    }
}
