<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'ressources';
    protected $primaryKey = 'id_ressource';

    protected $fillable = [
        'titre_ressource',
        'contenu_texte_ressource',
        'fk_id_uti',
        'fk_id_categorie',
        'fk_id_piece_jointe',
        'status',
        'partage_ressource',
        'date_publication_ressource',
        'raison_refus_ressource',
    ];

    public function Utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function Categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
