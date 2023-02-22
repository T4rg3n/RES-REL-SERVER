<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceJointe extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'piece_jointes';

    public function Ressource()
    {
        return $this->belongsTo(Ressource::class);
    }

    public function Utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
