<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'categories';
    protected $primaryKey = 'id_categorie';

    protected $fillable = [
        'nom_categorie',
    ];

    public function Ressource()
    {
        return $this->hasMany(Ressource::class);
    }
}
