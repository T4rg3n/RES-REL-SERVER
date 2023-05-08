<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'roles';
    protected $primaryKey = 'id_role';

    protected $fillable = [
        'nom_role',
    ];

    public function Utilisateur()
    {
        return $this->hasMany(Utilisateur::class);
    }
}
