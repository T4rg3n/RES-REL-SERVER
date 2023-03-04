<?php

namespace App\Http\Controllers\V1;

use App\Models\Categorie;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategorieResource;
use App\Http\Resources\V1\CategorieCollection;
use App\Http\Requests\V1\StoreCategorieRequest;
use App\Http\Requests\V1\UpdateCategorieRequest;
use Illuminate\Http\Request;
use App\Services\V1\QueryFilter;

class CategorieController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'nom' => ['equals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_categorie',
        'nom' => 'nom_categorie',
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
        $categories = Categorie::where($eloquentQuery)->paginate($perPage);

        return new CategorieCollection($categories->appends($request->query()));
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
        $categorie = Categorie::create($request->all());
        $categorie->save();
        $id = $categorie->id;

        return response()->json($this->show($id), 201);
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
   /* public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        //
    }*/

    //choses à faire API :
    /*
    TODO doc readme
    TODO vérif nommage entre db & translator
    TODO create sur tous les endpoints
    */

    /*
    Choses qu'on delete:
                     DONE:      TEST:
        - categorie     x       
        - relation      x
        - typeRelation  x
        - groupe        x
        - role          x
        - favoris       x

    Choses qu'on désactive:
        - utilisateur           x     
        - ressource             x  (PJ en conséquense si présente)<= à réfléchir
        - commentaire           x
        - reponses_commentaire  x
    */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_categorie)
    {
        $categorie = Categorie::findOrfail($id_categorie);
        $categorie->delete($id_categorie);

        return response()->json([
            'message' => 'Categorie deleted'
        ], 200);
    }
}
