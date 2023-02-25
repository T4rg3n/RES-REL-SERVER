<?php

namespace App\Http\Controllers\V1;

use App\Models\PieceJointe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PieceJointeResource;
use App\Http\Resources\V1\PieceJointeCollection;
use App\Services\V1\QueryFilter;

class PieceJointeController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'idUtilisateur' => ['equals'],
        'type' => ['equals'],
        'dateCreation' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'dateActivite' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'lieu' => ['equals'],
        'codePostal' => ['equals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_piece_jointe',
        'idUtilisateur' => 'fk_id_uti',
        'type' => 'type_pj',
        'dateCreation' => 'date_creation_pj',
        'dateActivite' => 'date_activite_pj',
        'lieu' => 'lieu_pj',
        'codePostal' => 'code_postal_pj',
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
        $piecesJointes = PieceJointe::where($eloquentQuery)->paginate();
        
        return new PieceJointeCollection($piecesJointes->appends($request->query()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id_piece_jointe)
    {
        $piece_jointe = PieceJointe::where('id_piece_jointe', $id_piece_jointe)->first();

        return new PieceJointeResource($piece_jointe);
    }
}
