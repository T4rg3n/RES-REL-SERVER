<?php

namespace App\Http\Controllers\V1;

use App\Models\Ressource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RefuseRessourceRequest;
use App\Http\Resources\V1\RessourceResource;
use App\Http\Resources\V1\RessourceCollection;
use App\Http\Requests\V1\StoreRessourceRequest;
use App\Services\V1\QueryFilter;

class RessourceController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'idCategorie' => ['equals'],
        'dateCreation' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'status' => ['equals'],
        'idUtilisateur' => ['equals'],
        'partage' => ['equals'],
        'datePublication' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_ressource',
        'idCategorie' => 'fk_id_categorie',
        'dateCreation' => 'date_creation_ressource',
        'status' => 'status',
        'idUtilisateur' => 'fk_id_uti',
        'partage' => 'partage_ressource',
        'datePublication' => 'date_publication_ressource',
        'idPieceJointe' => 'fk_id_piece_jointe',
    ];

    /**
     * Allowed includes
     */
    protected $allowedIncludes = [
        'categorie',
        'utilisateur',
        'pieceJointe'
    ];

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = request()->input('perPage', 15);
        $queryContent = $request->all();
        $filter = new QueryFilter();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $ressources = Ressource::where($eloquentQuery);   
        
        $includes = $request->query('include');
        if ($includes) {
            $includedRessources = explode(',', $includes);
            foreach($includedRessources as $includedRessource) {
                if (in_array($includedRessource, $this->allowedIncludes)) {
                    $ressources = $ressources->with($includedRessource);
                } else {
                    return response()->json([
                        'message' => 'Invalid include'
                    ], 400);
                }
            }
        }
        
        return new RessourceCollection($ressources->paginate($perPage)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRessourceRequest $request)
    {
        $ressource = Ressource::create($request->all());
        $ressource->save();
        $id = $ressource->id_ressource;

        return response()->json($this->show($id), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_ressource
     * @return \Illuminate\Http\Response
     */
    public function show($id_ressource)
    {
        $ressource = Ressource::findOrfail($id_ressource);

        $includes = request()->query('include');
        if ($includes) {
            $includedRessources = explode(',', $includes);
            foreach($includedRessources as $includedRessource) {
                if (in_array($includedRessource, $this->allowedIncludes)) {
                    $ressource = $ressource->loadMissing($includedRessource);
                } else {
                    return response()->json([
                        'message' => 'Invalid include'
                    ], 400);
                }
            }
        }

        return new RessourceResource($ressource);
    }

    /**
     * Refuse the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function disable(RefuseRessourceRequest $request)
    {
        $ressource = Ressource::findOrfail($request->id_ressource);
    
        if($ressource->status != 'PENDING') {
            return response()->json([
                'message' => 'Ressource is not pending'
            ], 400);
        }

        $ressource->status = 'REJECTED';
        $ressource->raison_refus_ressource = $request->raison_refus_ressource;
        $ressource->save();

        return response()->json([
            'message' => 'Ressource refused'
        ], 200);
    }

    /**
     * Accept the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enable($id_ressource)
    {
        $ressource = Ressource::findOrfail($id_ressource);

        if($ressource->status != 'PENDING') {
            return response()->json([
                'message' => 'Ressource is not pending'
            ], 400);
        }

        $ressource->status = 'APPROVED';
        $ressource->save();

        return response()->json([
            'message' => 'Ressource accepted'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  int  $id_ressource
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_ressource)
    {
        $ressource = Ressource::findOrfail($id_ressource);
        $ressource->delete();

        return response()->json([
            'message' => 'Ressource deleted'
        ], 200);
    }
}
