<?php

namespace App\Http\Controllers\V1;

use App\Models\Groupe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\GroupeResource;
use App\Http\Resources\V1\GroupeCollection;

class GroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new GroupeCollection(Groupe::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id_groupe)
    {
        $groupe = Groupe::where('id_groupe', $id_groupe)->first();

        return new GroupeResource($groupe);
    }
}
