<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoris extends Model
{
    use HasFactory;
    
    protected $table = 'favoris';
    public $timestamps = false;

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
