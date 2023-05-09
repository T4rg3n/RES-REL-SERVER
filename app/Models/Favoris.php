<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoris extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'favoris';
    protected $primaryKey = 'id_favoris';

    protected $fillable = [
        'fk_id_uti',
        'fk_id_ressource',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'fk_id_uti', 'id_uti');
    }

    public function ressource()
    {
        return $this->belongsTo(Ressource::class, 'fk_id_ressource', 'id_ressource');
    }
}
