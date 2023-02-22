<?php

namespace App\Http\Controllers\V1;

use App\Models\Ressource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RessourceResource;
use App\Http\Resources\V1\RessourceCollection;

class RessourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new RessourceCollection(Ressource::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_ressource
     * @return \Illuminate\Http\Response
     */
    public function show($id_ressource)
    {
        $ressource = Ressource::where('id_ressource', $id_ressource)->first();

        return new RessourceResource($ressource);
    }
}
