<?php

namespace App\Http\Controllers\V1;

use App\Models\Favoris;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FavorisResource;
use App\Http\Resources\V1\FavorisCollection;

class FavorisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new FavorisCollection(Favoris::paginate());
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id_favoris
     * @return \Illuminate\Http\Response
     */
    public function show($id_favoris)
    {
        $favoris = Favoris::where('id_favoris', $id_favoris)->first();

        return new FavorisResource($favoris);
    }
}
