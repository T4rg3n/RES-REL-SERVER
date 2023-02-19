<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $table = 'commentaires';

    public function Ressource()
    {
        return $this->belongsTo(Ressource::class);
    }

    public function Utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
