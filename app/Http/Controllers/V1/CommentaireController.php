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
     * Allowed includes
     */
    protected $allowedIncludes = [
        'utilisateur',
        'ressource'
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

        $typeOrder = 'asc';
        $fieldOrder = 'id_commentaire';

        $orderBy = $request->query('orderBy');
        if($orderBy) {
            $orderByArray = explode(',', $orderBy);
            if (count($orderByArray) == 2) {
                $fieldOrder = $orderByArray[0];
                $typeOrder = $orderByArray[1];
            }
        }

        $commentaires = Commentaire::where($eloquentQuery)->orderBy($fieldOrder, $typeOrder);

        $includes = $request->query('include');
        if ($includes) {
            $includedArray = explode(',', $includes);
            foreach($includedArray as $include) {
                if (in_array($include, $this->allowedIncludes)) {
                    $commentaires->with($include);
                } else {
                    return response()->json([
                        'message' => 'Invalid include'],
                    400);
                }
            }
        }

        return new CommentaireCollection($commentaires->paginate($perPage)->appends($request->query()));
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
        $id = $commentaire->id_commentaire;

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
        $commentaire = Commentaire::findOrfail($id_commentaire);

        return new CommentaireResource($commentaire);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_commentaire)
    {
        $commentaire = Commentaire::findOrfail($id_commentaire);
        $commentaire->delete();

        return response()->json([
            'message' => 'Commentaire deleted'
        ], 200);
    }

    /**
     * Disable the specified resource in the database.
     */
    public function disable($id_commentaire)
    {
        $commentaire = Commentaire::findOrfail($id_commentaire);
        $commentaire->commentaire_supprime = true;
        $commentaire->save();

        return response()->json([
            'message' => 'Commentaire disabled'
        ], 200);
    }

    /**
     * Increment the report counter by 1.
     */
    public function report($id_commentaire)
    {
        $commentaire = Commentaire::findOrfail($id_commentaire);
        $commentaire->nombre_signalement_commentaire += 1;
        $commentaire->save();

        return response()->json([
            'message' => 'Commentaire reported'
        ], 200);
    }
}
