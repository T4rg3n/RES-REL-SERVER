<?php

namespace App\Http\Controllers\V1;

use App\Models\Ressource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RefuseRessourceRequest;
use App\Http\Resources\V1\RessourceResource;
use App\Http\Resources\V1\RessourceCollection;
use App\Http\Requests\V1\StoreRessourceRequest;
use App\Models\Categorie;
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //TODO: Add piece jointe as related data to ressource
        $perPage = request()->input('perPage', 15);
        $queryContent = $request->all();
        $filter = new QueryFilter();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $ressources = Ressource::where($eloquentQuery)->paginate($perPage);

        $includes = $request->query('include');
        $includedRessources = explode(',', $includes);

        if ($includes) {
            foreach($includedRessources as $includedRessource) {
                if (!in_array($includedRessource, $this->allowedIncludes)) {
                    return response()->json([
                        'message' => 'Invalid include'
                    ], 400);
                }
            }

            $ressources = Ressource::with('categorie')->get();
        
            $ressources->transform(function ($ressource) {
                $ressource->categorie;
                unset($ressource->idCategorie);
                return $ressource;
            });

            return response()->json(['data' => $ressources], 200);
            //$ressources->load($includedRessources);
        }

        return new RessourceCollection($ressources->appends($request->query()));
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
        //TODO error parsing if resource != PENDING
        $ressource = Ressource::findOrfail($request->id_ressource);
        $ressource->status = 'REJECTED';
        $ressource->raison_refus_ressource = $request->raison_refus_ressource;
        $ressource->save();

        return response()->json([
            'message' => 'Ressource disabled'
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
