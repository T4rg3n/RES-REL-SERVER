<?php

namespace App\Http\Controllers\V1;

use App\Models\Ressource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RefuseRessourceRequest;
use App\Http\Resources\V1\RessourceResource;
use App\Http\Resources\V1\RessourceCollection;
use App\Http\Requests\V1\StoreRessourceRequest;
use App\Services\V1\QueryService;

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
        $eloquentQuery = (new QueryService())->transform($queryContent, $this->allowedParams, $this->columnMap);

        //TODO review this
        // Allows multiple filters on the same column (ex: ?id[equals]=1&id[equals]=2)
        // Used for infinite scroll on the front-end, only on RessourceController
        $ressources = Ressource::query();
        foreach ($eloquentQuery as $columnName => $operators) {
            foreach ($operators as $operator => $values) {
                $ressources->where(function ($query) use ($columnName, $operator, $values) {
                    foreach ($values as $value) {
                        $query->orWhere($columnName, $operator, $value);
                    }
                });
            }
        }

        // Order by
        [$fieldOrder, $typeOrder] = (new QueryService())->translateOrderBy($request->query('orderBy'), 'id_ressource', $this->columnMap);
        $ressources->orderBy($fieldOrder, $typeOrder);

        // Include
        $include = (new QueryService())->include(request(), $this->allowedIncludes);
        if ($include) {
            $ressources->with($include);
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

        $include = (new QueryService())->include(request(), $this->allowedIncludes);
        if ($include) {
            $ressource->load($include);
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
