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
        'demandeur',
        'receveur',
        'typeRelation'
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
        [$fieldOrder, $typeOrder] = (new QueryService())->translateOrderBy($request->query('orderBy'), 'id_relation', $this->columnMap);
        $relations = Relation::where($eloquentQuery)->orderBy($fieldOrder, $typeOrder);

        // Include
        $include = (new QueryService())->include(request(), $this->allowedIncludes);
        if ($include) {
            $relations->with($include);
        }

        //FromUtilisateur
        $fromUtilisateur = $request->query('fromUtilisateur');
        if($fromUtilisateur) {
            $relations = Relation::whereHas('demandeur', function ($query) use ($fromUtilisateur) {
                $query->where('receveur_id', $fromUtilisateur)
                    ->where('accepte', true);
                })
                ->orWhereHas('receveur', function ($query) use ($fromUtilisateur) {
                    $query->where('demandeur_id', $fromUtilisateur)
                        ->where('accepte', true);
                });
        }

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
     * Accept a pending relation.
     * 
     * @param  \Illuminate\Http\StoreRelationRequest  $request
     * @param  int  $id_relation
     * @return \Illuminate\Http\Response
     */
    public function accept($id_relation)
    {
        $relation = Relation::findOrfail($id_relation);

        if($relation->accepte != null) {
            return response()->json([
                'message' => 'Relation already fulfilled'
            ], 400);
        }

        $relation->accepte = true;
        //TODO rename date_acceptation to a more generic name
        $relation->date_acceptation = now();
        $relation->save();

        return response()->json([
            'message' => 'Relation accepted'
        ], 200);
    }

    /**
     * Refuse a pending relation.
     * 
     * @param  \Illuminate\Http\StoreRelationRequest  $request
     * @param  int  $id_relation
     * @return \Illuminate\Http\Response
     */
    public function refuse($id_relation)
    {
        $relation = Relation::findOrfail($id_relation);

        if($relation->accepte != null) {
            return response()->json([
                'message' => 'Relation already fulfilled'
            ], 400);
        }

        $relation->accepte = false;
        //TODO rename date_acceptation to a more generic name
        $relation->date_acceptation = now();
        $relation->save();

        return response()->json([
            'message' => 'Relation refused'
        ], 200);
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

        $include = (new QueryService())->include(request(), $this->allowedIncludes);
        if ($include) {
            $relation->load($include);
        }

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
