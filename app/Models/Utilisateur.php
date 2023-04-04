<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'photo_uti'
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
        return $this->belongsTo(Role::class, 'fk_id_role', 'id_role');
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

    public function commentaire()
    {
        return $this->hasMany(Commentaire::class);
    }
}
