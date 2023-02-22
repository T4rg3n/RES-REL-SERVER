<?php

namespace App\Http\Controllers\V1;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UtilisateurResource;
use App\Http\Resources\V1\UtilisateurCollection;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UtilisateurCollection(Utilisateur::paginate());
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id_uti
     * @return \Illuminate\Http\Response
     */
    public function show($id_uti)
    {
        $utilisateur = Utilisateur::where('id_uti', $id_uti)->first();

        return new UtilisateurResource($utilisateur);
    }
    
}
