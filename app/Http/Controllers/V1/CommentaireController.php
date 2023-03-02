<?php

namespace App\Http\Controllers\V1;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CommentaireResource;
use App\Http\Resources\V1\CommentaireCollection;
use App\Http\Requests\V1\StoreCommentaireRequest;
use App\Services\V1\QueryFilter;

class CommentaireController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'idUtilisateur' => ['equals'],
        'idRessource' => ['equals'],
        'datePublication' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'nombreReponses' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'supprime' => ['equals'],
        'nombreSignalements' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_commentaire',
        'idUtilisateur' => 'fk_id_uti',
        'idRessource' => 'fk_id_ressource',
        'datePublication' => 'date_publication_commentaire',
        'nombreReponses' => 'nombre_reponses_commentaire',
        'supprime' => 'commentaire_supprime',
        'nombreSignalements' => 'nombre_signalement_commentaire',
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
        $commentaires = Commentaire::where($eloquentQuery)->paginate($perPage);

        return new CommentaireCollection($commentaires->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentaireRequest $request)
    {
        $commentaire = Commentaire::create($request->all());
        $commentaire->save();
        $id = $commentaire->id;

        return response()->json($this->show($id), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id_commentaire)
    {
        $commentaire = Commentaire::where('id_commentaire', $id_commentaire)->first();

        return new CommentaireResource($commentaire);
    }
}
