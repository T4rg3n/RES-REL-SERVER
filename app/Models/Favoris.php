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

    public function Utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function Ressource()
    {
        return $this->belongsTo(Ressource::class);
    }
}
