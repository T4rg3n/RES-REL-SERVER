<?php

namespace App\Http\Controllers\V1;

use App\Models\Ressource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //TODO: Add piece jointe as related data to ressource

        $queryContent = $request->all();
        $filter = new QueryFilter();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $ressources = Ressource::where($eloquentQuery)->paginate();

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
        //$request->prepareForValidation();
        /* //$request->prepareForValidation();
        try{
            $ressource = new Ressource;
            $ressource->fill($request->validated())->save();

        } catch (\Exception $e) {
            throw new HttpException(400, "Bad request : " . $e->getMessage());
        }

        //return new RessourceResource(Ressource::create($request->query()));
        //
        */
        // $request->add([
        //     'status' => 'PENDING', 
        //     'partage_ressource' => 'PRIVATE',
        //     'date_publication_ressource' => '0000-00-00 00:00:00', //TODO: Change this to null
        //     'raison_refus_ressource' => '', //TODO: Change this to null
        // ]);
        
        //add values so the user doesn't have to
        $request->merge([
            'status' => 'PENDING', 
            'partage_ressource' => 'PRIVATE',
        ]);

        $ressource = new Ressource();
        
       /*I have a specitic usecase. So, I'm using a class I named StoreRessourceRequest that handles the translation between the database tables names and the data that is submitted by the user with POST. It's called in my 'store()' function in my RessourceController. The function store returns this : return new RessourceResource( Ressource::create($request->all()))
        Then, how do I print the autoincrement id (handled by MySQL) as the response json object after the POST?*/

        /** Is there a way to prevent my user from filling fields but being able to fill them with code? (so not putting every field in the $fillable array)? */

        return new RessourceResource( Ressource::create($request->all()));
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
