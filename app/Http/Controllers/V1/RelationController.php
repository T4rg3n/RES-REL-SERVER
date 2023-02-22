<?php

namespace App\Http\Controllers\V1;

use App\Models\Relation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RelationResource;
use App\Http\Resources\V1\RelationCollection;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new RelationCollection(Relation::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id_relation)
    {
        $relation = Relation::where('id_relation', $id_relation)->first();

        return new RelationResource($relation);
    }
}
