<?php

namespace App\Http\Controllers\V1;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Commentaire::all();
    }
}
