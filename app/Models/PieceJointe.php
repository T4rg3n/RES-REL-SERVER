<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceJointe extends Model
{
    use HasFactory;
    protected $table = 'piece_jointe';

    public function Ressource()
    {
        return $this->belongsTo(Ressource::class);
    }

    public function Utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
