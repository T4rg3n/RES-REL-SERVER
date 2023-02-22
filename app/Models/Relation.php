<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'relations';

    public function TypeRelation ()
    {
        return $this->belongsTo(TypeRelation::class);
    }
}
