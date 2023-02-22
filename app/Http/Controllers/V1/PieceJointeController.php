<?php

namespace App\Http\Controllers\V1;

use App\Models\PieceJointe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PieceJointeResource;
use App\Http\Resources\V1\PieceJointeCollection;

class PieceJointeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PieceJointeCollection(PieceJointe::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id_piece_jointe)
    {
        $piece_jointe = PieceJointe::where('id_piece_jointe', $id_piece_jointe)->first();

        return new PieceJointeResource($piece_jointe);
    }
}
