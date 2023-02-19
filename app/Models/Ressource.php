<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;
    protected $table = 'ressources';

    public function Utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function Categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
