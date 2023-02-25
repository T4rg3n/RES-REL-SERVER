<?php

namespace App\Http\Controllers\V1;

use App\Models\Ressource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RessourceResource;
use App\Http\Resources\V1\RessourceCollection;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queryContent = $request->all();
        $filter = new QueryFilter();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $ressources = Ressource::where($eloquentQuery)->paginate();

        return new RessourceCollection($ressources->appends($request->query()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_ressource
     * @return \Illuminate\Http\Response
     */
    public function show($id_ressource)
    {
        $ressource = Ressource::where('id_ressource', $id_ressource)->first();

        return new RessourceResource($ressource);
    }
}
