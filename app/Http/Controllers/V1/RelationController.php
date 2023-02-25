<?php

namespace App\Http\Controllers\V1;

use App\Models\Relation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RelationResource;
use App\Http\Resources\V1\RelationCollection;
use App\Services\V1\QueryFilter;

class RelationController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'demandeur' => ['equals'],
        'receveur' => ['equals'],
        'accepte' => ['equals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_relation',
        'demandeur' => 'demandeur_id',
        'receveur' => 'receveur_id',
        'accepte' => 'accepte',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queryContent = $request->all();
        $filter = new QueryFilter();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $relations = Relation::where($eloquentQuery)->paginate();
        
        return new RelationCollection($relations->appends($request->query()));
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
