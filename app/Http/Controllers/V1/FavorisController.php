<?php

namespace App\Http\Controllers\V1;

use App\Models\Favoris;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreFavorisRequest;
use App\Http\Resources\V1\FavorisResource;
use App\Http\Resources\V1\FavorisCollection;
use App\Services\V1\QueryFilter;

class FavorisController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'dateFav' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'idUtilisateur' => ['equals'],
        'idRessource' => ['equals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_favoris',
        'dateFav' => 'date_fav',
        'idUtilisateur' => 'fk_id_uti',
        'idRessource' => 'fk_id_ressource',
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
        $favoris = Favoris::where($eloquentQuery)->paginate($perPage);
        
        return new FavorisCollection($favoris->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFavorisRequest $request)
    {
        $favoris = Favoris::create($request->all());
        $favoris->save();
        $id = $favoris->id_favoris;
        
        return response()->json($this->show($id), 201);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id_favoris
     * @return \Illuminate\Http\Response
     */
    public function show($id_favoris)
    {
        $favoris = Favoris::findOrfail($id_favoris);

        return new FavorisResource($favoris);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id_favoris
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_favoris)
    {
        $favoris = Favoris::findOrfail($id_favoris);
        $favoris->delete();

        return response()->json([
            'message' => 'Favoris deleted'
        ], 200);
    }
}
