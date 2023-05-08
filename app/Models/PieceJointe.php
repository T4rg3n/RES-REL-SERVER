<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceJointe extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'piece_jointes';
    protected $primaryKey = 'id_piece_jointe';

    protected $fillable = [
        'type_pj',
        'titre_pj',
        'description_pj',
        'contenu_pj',
        'date_activite_pj',
        'lieu_pj',
        'code_postal_pj',
        'fk_id_uti',
    ];

    public function ressource()
    {
        return $this->belongsTo(Ressource::class, 'fk_id_ressource', 'id_ressource');
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'fk_id_uti', 'id_uti');
    }
}
