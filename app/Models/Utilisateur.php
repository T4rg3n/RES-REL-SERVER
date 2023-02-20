<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;
    protected $table = 'utilisateur';

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }

    public function Groupe()
    {
        return $this->belongsTo(Groupe::class);
    }

    public function Ressource()
    {
        return $this->hasMany(Ressource::class);
    }

    public function Favoris()
    {
        return $this->hasMany(Favoris::class);
    }

    public function Commentaire()
    {
        return $this->hasMany(Commentaire::class);
    }
}
