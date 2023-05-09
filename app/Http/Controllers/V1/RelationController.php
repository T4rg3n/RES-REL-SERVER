<?php

namespace App\Http\Controllers\V1;

use App\Models\Relation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RelationResource;
use App\Http\Resources\V1\RelationCollection;
use App\Http\Requests\V1\StoreRelationRequest;
use App\Services\V1\QueryService;

class RelationController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'typeRelation' => ['equals'],
        'idDemandeur' => ['equals'],
        'idReceveur' => ['equals'],
        'accepte' => ['equals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_relation',
        'idDemandeur' => 'demandeur_id',
        'idReceveur' => 'receveur_id',
        'dateDemande' => 'date_demande',
        'dateAcceptation' => 'date_acceptation',
        'accepte' => 'accepte',
    ];

    /**
     * Allowed includes
     */
    protected $allowedIncludes = [
        'idDemandeur',
        'idReceveur'
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

        // Order by
        [$fieldOrder, $typeOrder] = (new QueryService)->translateOrderBy($request->query('orderBy'), 'id_relation', $this->columnMap); 
        $relations = Relation::where($eloquentQuery)->orderBy($fieldOrder, $typeOrder); 
        
        return new RelationCollection($relations->paginate($perPage)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\StoreRelationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRelationRequest $request)
    {
        $relation = Relation::create($request->all());
        $relation->save();
        $id = $relation->id_relation;
        
        return response()->json($this->show($id), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id_relation)
    {
        $relation = Relation::findOrfail($id_relation);

        return new RelationResource($relation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_relation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_relation)
    {
        $groupe = Relation::findOrfail($id_relation);
        $groupe->delete($id_relation);

        return response()->json([
            'message' => 'Relation deleted'
        ], 200);
    }
}
