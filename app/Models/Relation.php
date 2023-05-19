<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'relations';
    protected $primaryKey = 'id_relation';

    protected $fillable = [
        'demandeur_id',
        'receveur_id',
        'fk_id_type_relation',
        'accepte',
    ];

    public function TypeRelation()
    {
        return $this->belongsTo(TypeRelation::class);
    }

    public function demandeur()
    {
        return $this->belongsTo(Utilisateur::class, 'demandeur_id', 'id_uti');
    }

    public function receveur()
    {
        return $this->belongsTo(Utilisateur::class, 'receveur_id', 'id_uti');
    }
}
