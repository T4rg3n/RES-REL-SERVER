<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'categorie';

    public function Ressource()
    {
        return $this->hasMany(Ressource::class);
    }
}
