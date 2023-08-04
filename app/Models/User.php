<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telephonne',
        'adresse',
        "cin",
        "role"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function reclamations(){
        return $this->hasMany(Reclamation::class,"id","id");
    }
    /*------------------------------------------------------------------ */
    public function catalogues(){
        return $this->hasMany(Catalogue::class,"id","id");
    }
    /*------------------------------------------------------------------ */
    public function commandes(){
        return $this->hasMany(Commande::class,"id","id");
    }
    /*------------------------------------------------------------------ */
    public function livraisons(){
        return $this->hasMany(Livraison::class,"id","id");
    }
    /*------------------------------------------------------------------ */
    public function paiements(){
        return $this->hasMany(Paiement::class,"id","id");
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["admin","client","fournisseur","livreur"][$value],
        );
    }
}
