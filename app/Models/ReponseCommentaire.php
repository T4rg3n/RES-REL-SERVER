<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReponseCommentaire extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'reponses_commentaires';
    protected $primaryKey = 'id_reponse';

    protected $fillable = [
        'contenu_reponse',
        'fk_id_uti',
        'fk_id_commentaire',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'fk_id_uti', 'id_uti');
    }

    public function commentaire()
    {
        return $this->belongsTo(Commentaire::class, 'fk_id_commentaire', 'id_commentaire');
    }
}
