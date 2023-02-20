<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReponseCommentaire extends Model
{
    use HasFactory;
    protected $table = 'reponses_commentaire';

    public function Utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function Commentaire()
    {
        return $this->belongsTo(Commentaire::class);
    }
}
