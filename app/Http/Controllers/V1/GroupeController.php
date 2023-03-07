<?php

namespace App\Http\Controllers\V1;

use App\Models\Groupe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\GroupeResource;
use App\Http\Resources\V1\GroupeCollection;
use App\Http\Requests\V1\StoreGroupeRequest;
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
        $perPage = request()->input('perPage', 15);
        $queryContent = $request->all();
        $filter = new QueryFilter();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $groupe = Groupe::where($eloquentQuery)->paginate($perPage);    

        return new GroupeCollection($groupe->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\StoreGroupeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupeRequest $request)
    {
        $groupe = Groupe::create($request->all());
        $groupe->save();
        $id = $groupe->id_groupe;

        return response()->json($this->show($id), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id_groupe)
    {
        $groupe = Groupe::findOrfail($id_groupe);

        return new GroupeResource($groupe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_groupe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_groupe)
    {
        $groupe = Groupe::findOrfail($id_groupe);
        $groupe->delete($id_groupe);

        return response()->json([
            'message' => 'Groupe deleted'
        ], 200);
    }
}
