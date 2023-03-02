<?php

namespace App\Http\Controllers\V1;

use App\Models\ReponseCommentaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ReponseCommentaireResource;
use App\Http\Resources\V1\ReponseCommentaireCollection;
use App\Http\Requests\V1\StoreReponseCommentaireRequest;
use App\Services\V1\QueryFilter;

class ReponseCommentaireController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'date' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'supprime' => ['equals'],
        'nombreSignalement' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'idUtilisateur' => ['equals'],
        'idCommentaire' => ['equals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_reponse',
        'date' => 'date_publication_reponse', //BUG date is null in GET request but not in DB
        'supprime' => 'reponse_supprime',
        'nombreSignalement' => 'nombre_signalement_commentaire',
        'idUtilisateur' => 'fk_id_uti',
        'idCommentaire' => 'fk_id_commentaire',
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
        $reponsesCommentaires = ReponseCommentaire::where($eloquentQuery)->paginate($perPage);

        return new ReponseCommentaireCollection($reponsesCommentaires->appends($request->query())); 
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\StoreReponseCommentaireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReponseCommentaireRequest $request)
    {
        $reponseCommentaire = ReponseCommentaire::create($request->all());
        $reponseCommentaire->save();
        $id = $reponseCommentaire->id;

        return response()->json($this->show($id), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id_reponse)
    {
        $reponse_commentaire = ReponseCommentaire::where('id_reponse', $id_reponse)->first();

        return new ReponseCommentaireResource($reponse_commentaire);
    }
}
