<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRelation extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'type_relations';

    public function Relation()
    {
        return $this->hasMany(Relation::class);
    }

}
