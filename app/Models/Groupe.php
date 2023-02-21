<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'groupe';
    
    public function Utilisateur()
    {
        return $this->hasMany(Utilisateur::class);
    }  
}
