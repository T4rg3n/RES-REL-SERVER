<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'groupes';

    protected $fillable = [
        'nom_groupe',
        'description_groupe',
        'est_prive_groupe',
    ];
    
    public function Utilisateur()
    {
        return $this->hasMany(Utilisateur::class);
    }  
}
