<?php

namespace App\Http\Controllers\V1;

use App\Models\PieceJointe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PieceJointeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PieceJointe::all();
    }
}
