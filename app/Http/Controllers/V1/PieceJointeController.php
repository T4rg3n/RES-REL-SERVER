<?php

namespace App\Http\Controllers\V1;

use App\Models\PieceJointe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PieceJointeResource;
use App\Http\Resources\V1\PieceJointeCollection;
use App\Http\Requests\V1\StorePieceJointeRequest;
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
        $perPage = request()->input('perPage', 15);
        $queryContent = $request->all();
        $filter = new QueryFilter();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $piecesJointes = PieceJointe::where($eloquentQuery)->paginate($perPage);
        
        return new PieceJointeCollection($piecesJointes->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\StorePieceJointeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePieceJointeRequest $request)
    {
        $pieceJointe = PieceJointe::create($request->all());
        $pieceJointe->save();
        $id = $pieceJointe->id;

        $uploadedFile = $request->file('contenu_pj');
        $fileName = $id . '_' . $uploadedFile->getClientOriginalName()->extension();
        $filePath = 'public/files/' . $pieceJointe->fk_id_uti;

        switch ($request->input('type_pj')) {
            case('IMAGE'):
                $filePath .= '//image//';
                break;
            case('VIDEO'):
                $filePath .= '//video//';
            case('PDF'):
                $filePath .= '//pdf//';
            default:
                break;
        }

        $uploadedFile->storeAs($filePath, $fileName);
       
        return response()->json($this->show($id), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($idPieceJointe)
    {
        $pieceJointe = PieceJointe::where('id_piece_jointe', $idPieceJointe)->first();

        return new PieceJointeResource($pieceJointe);
    }
}
