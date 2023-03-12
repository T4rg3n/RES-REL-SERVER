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
        'bio_uti',
        'fk_id_role',
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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }

    public function ressource()
    {
        return $this->hasMany(Ressource::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favoris::class);
    }

    public function Commentaire()
    {
        return $this->hasMany(Commentaire::class);
    }
}
