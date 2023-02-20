<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRelation extends Model
{
    use HasFactory;
    protected $table = 'type_relation';

    public function Relation()
    {
        return $this->hasMany(Relation::class);
    }

}
