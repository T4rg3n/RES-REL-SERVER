<?php

namespace App\Http\Controllers\V1;

use App\Models\TypeRelation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TypeRelationResource;
use App\Http\Resources\V1\TypeRelationCollection;
use App\Http\Requests\V1\StoreTypeRelationRequest;
use App\Services\V1\QueryService;

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
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_type_relation',
        'nom' => 'nom_type_relation',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = request()->input('perPage', 15);
        $queryContent = $request->all();
        $filter = new QueryService();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $typesRelations = TypeRelation::where($eloquentQuery);

        return new TypeRelationCollection($typesRelations->paginate($perPage)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreTypeRelationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRelationRequest $request)
    {
        $typeRelation = TypeRelation::create($request->all());
        $typeRelation->save();
        $id = $typeRelation->id_type_relation;

        return response()->json($this->show($id), 201);
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_type_relation
     * @return \Illuminate\Http\Response
     */
    public function show($id_type_relation)
    {
        $type_relation = TypeRelation::findOrfail($id_type_relation);

        return new TypeRelationResource($type_relation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_type_relation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_type_relation)
    {
        $typeRelation = TypeRelation::findOrfail($id_type_relation);
        $typeRelation->delete();

        return response()->json([
            'message' => 'Type relation deleted'
        ], 200);
    }
}
