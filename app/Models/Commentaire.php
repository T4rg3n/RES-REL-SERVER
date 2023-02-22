<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'commentaires';

    public function Ressource()
    {
        return $this->belongsTo(Ressource::class);
    }

    public function Utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function ReponseCommentaire()
    {
        return $this->hasMany(ReponseCommentaire::class);
    }
}
