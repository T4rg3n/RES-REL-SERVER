<?php

namespace App\Http\Controllers\V1;


use App\Models\Categorie;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategorieResource;
use App\Http\Resources\V1\CategorieCollection;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use Illuminate\Http\Request;
use App\Services\V1\CategorieQuery;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new CategorieQuery();
        $queryItems = $filter->transform($request);

        //WIP for test
        return new CategorieCollection(Categorie::where($queryItems));
        
/*
        if(count($queryItems) == 0) {
            //return $request;
            //return new CategorieCollection(Categorie::paginate());
            return new CategorieCollection(Categorie::where($queryItems)->paginate());
        } else {
            //return $queryItems;
            return new CategorieCollection(Categorie::where($queryItems)->paginate());
        }    
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategorieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategorieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_categorie
     * @return \Illuminate\Http\Response
     */
    public function show($id_categorie)
    {
        $categorie = Categorie::where('id_categorie', $id_categorie)->first();

        return new CategorieResource($categorie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategorieRequest  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        //
    }
}
