<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    use HasFactory;
    protected $table="catalogues";
    protected $primaryKey="id_catalogue";
    protected $fillable=["id_catalogue","title","description","id","image"];
    public function user(){
        return $this->belongsTo(User::class,"id","id");
    }
}
