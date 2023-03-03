<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_uti';

    protected $fillable = [
        'mail_uti',
        'mdp_uti',
        'date_naissance_uti',
        'code_postal_uti',
        'nom_uti',
        'prenom_uti',
        'photo_uti',
        'bio_uti'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    /*
    protected $hidden = [
        'password',
        'remember_token',
    ];
    */
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /*
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    */

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }

    public function Groupe()
    {
        return $this->belongsTo(Groupe::class);
    }

    public function Ressource()
    {
        return $this->hasMany(Ressource::class);
    }

    public function Favoris()
    {
        return $this->hasMany(Favoris::class);
    }

    public function Commentaire()
    {
        return $this->hasMany(Commentaire::class);
    }
}
