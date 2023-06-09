<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'bookmarks';
    protected $primaryKey = 'id_bookmark';

    protected $fillable = [
        'fk_id_uti',
        'fk_id_ressource',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(utilisateur::class, 'fk_id_uti', 'id_uti');
    }

    public function ressource()
    {
        return $this->belongsTo(ressource::class, 'fk_id_ressource', 'id_ressource');
    }

}
