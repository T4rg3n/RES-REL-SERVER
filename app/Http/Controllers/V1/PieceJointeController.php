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

        return response()->json($this->show($id), 201);
    }

    public function uploadFile(Request $request)
    {
        $validatedData = $request->validate([
            'file' => ['required', 'file', 'max:10240']
        ]);

        $uploadedFile = $request->file('file');
        $tempFilePath = $uploadedFile->store('temp');

        // move the uploaded file to its final location
        $finalFilePath = Storage::putFile('files', $uploadedFile);

        // return a response to the client
        return response()->json([
            'message' => 'File uploaded successfully.',
            'file' => [
                'name' => $uploadedFile->getClientOriginalName(),
                'size' => $uploadedFile->getSize(),
                'path' => $finalFilePath,
            ],
        ]);
    }
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
