<?php

namespace App\Http\Controllers\V1;

use App\Models\TypeRelation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TypeRelationResource;
use App\Http\Resources\V1\TypeRelationCollection;

/**
 * @OA\Info(title="Search API", version="1.0.0")
 */
class TypeRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TypeRelationCollection(TypeRelation::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_type_relation
     * @return \Illuminate\Http\Response
     */
    public function show($id_type_relation)
    {
        $type_relation = TypeRelation::where('id_type_relation', $id_type_relation)->first();

        return new TypeRelationResource($type_relation);
    }
}
