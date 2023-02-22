<?php

namespace App\Http\Controllers\V1;

use App\Models\ReponseCommentaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ReponseCommentaireResource;
use App\Http\Resources\V1\ReponseCommentaireCollection;

class ReponseCommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ReponseCommentaireCollection(ReponseCommentaire::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id_reponse)
    {
        $reponse_commentaire = ReponseCommentaire::where('id_reponse', $id_reponse)->first();

        return new ReponseCommentaireResource($reponse_commentaire);
    }
}
