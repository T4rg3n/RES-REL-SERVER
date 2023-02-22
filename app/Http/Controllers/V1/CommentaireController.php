<?php

namespace App\Http\Controllers\V1;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CommentaireResource;
use App\Http\Resources\V1\CommentaireCollection;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CommentaireCollection(Commentaire::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id_commentaire)
    {
        $commentaire = Commentaire::where('id_commentaire', $id_commentaire)->first();

        return new CommentaireResource($commentaire);
    }
}
