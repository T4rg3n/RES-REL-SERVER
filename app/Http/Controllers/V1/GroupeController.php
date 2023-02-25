<?php

namespace App\Http\Controllers\V1;

use App\Models\Groupe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\GroupeResource;
use App\Http\Resources\V1\GroupeCollection;
use App\Services\V1\QueryFilter;

class GroupeController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'nom' => ['equals'],
        'estPrive' => ['equals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_groupe',
        'nom' => 'nom_groupe',
        'estPrive' => 'est_prive_groupe',
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
        $groupe = Groupe::where($eloquentQuery)->paginate();    

        return new GroupeCollection($groupe->appends($request->query()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id_groupe)
    {
        $groupe = Groupe::where('id_groupe', $id_groupe)->first();

        return new GroupeResource($groupe);
    }
}
