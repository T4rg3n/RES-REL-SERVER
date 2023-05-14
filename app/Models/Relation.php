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
}
