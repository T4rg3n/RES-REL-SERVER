<?php

namespace App\Http\Controllers\V1;

use App\Models\TypeRelation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TypeRelationResource;
use App\Http\Resources\V1\TypeRelationCollection;
use App\Services\V1\QueryFilter;

/**
 * @OA\Info(title="Search API", version="1.0.0")
 */
class TypeRelationController extends Controller
{
        /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'nom' => ['equals'],
        'dateCreation' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_type_relation',
        'nom' => 'nom_type_relation',
        'dateCreation' => 'date_creation',
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
        $typesRelations = TypeRelation::where($eloquentQuery)->paginate();

        return new TypeRelationCollection($typesRelations->appends($request->query()));
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
