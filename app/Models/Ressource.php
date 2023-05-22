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

    public function relationsAsDemandeur()
    {
        return $this->belongsToMany(Utilisateur::class, 'relations', 'demandeur_id', 'id_relation');
    }

    public function relationsAsReceveur()
    {
        return $this->belongsToMany(Utilisateur::class, 'relations', 'receveur_id', 'id_relation');
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'fk_id_uti', 'id_uti');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'fk_id_categorie', 'id_categorie');
    }

    public function pieceJointe()
    {
        return $this->belongsTo(PieceJointe::class, 'fk_id_piece_jointe', 'id_piece_jointe');
    }
}
