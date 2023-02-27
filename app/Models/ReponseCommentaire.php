<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReponseCommentaire extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'reponses_commentaires';

    protected $fillable = [
        'contenu_reponse',
        'fk_id_uti',
        'fk_id_commentaire',
    ];

    public function Utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function Commentaire()
    {
        return $this->belongsTo(Commentaire::class);
    }
}
