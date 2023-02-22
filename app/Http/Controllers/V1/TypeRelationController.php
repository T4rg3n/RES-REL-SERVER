<?php

namespace App\Http\Controllers\V1;

use App\Models\TypeRelation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TypeRelation::all();
    }
}
