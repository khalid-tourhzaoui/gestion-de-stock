<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;
    protected $table="reclamations";
    protected $fillable=["id_reclamation","id","message","date_reclamation"];
    protected $primaryKey="id_reclamation";
    public function user(){
        return $this->belongsTo(User::class,"id","id");
    }
}
