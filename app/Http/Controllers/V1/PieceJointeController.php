<?php

namespace App\Http\Controllers\V1;

use App\Models\PieceJointe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PieceJointeResource;
use App\Http\Resources\V1\PieceJointeCollection;
use App\Http\Requests\V1\StorePieceJointeRequest;
use App\Services\V1\QueryService;

class PieceJointeController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'idUtilisateur' => ['equals'],
        'idRessource' => ['equals'],
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
        'idRessource' => 'fk_id_ressource',
        'contenu' => 'contenu_pj',
        'type' => 'type_pj',
        'dateCreation' => 'date_creation_pj',
        'dateActivite' => 'date_activite_pj',
        'lieu' => 'lieu_pj',
        'codePostal' => 'code_postal_pj',
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
        $filter = new QueryService();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        
        // Order by
        [$fieldOrder, $typeOrder] = (new QueryService)->translateOrderBy($request->query('orderBy'), 'id_piece_jointe', $this->columnMap); 
        $piecesJointes = PieceJointe::where($eloquentQuery)->orderBy($fieldOrder, $typeOrder);

        $includes = $request->query('include');
        if ($includes) {
            $includedArray = explode(',', $includes);
            foreach ($includedArray as $include) {
                if (in_array($include, $this->allowedIncludes)) {
                    $piecesJointes->with($include);
                } else {
                    return response()->json([
                        'message' => 'Invalid include'
                    ], 400);
                }
            }
        }

        return new PieceJointeCollection($piecesJointes->paginate($perPage)->appends($request->query()));
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
        $id = $pieceJointe->id_piece_jointe;

        //For any case but 'ACTIVITE', the content is the path to the file
        if ($request->input('type_pj') != 'ACTIVITE') {
            $filePath = 'user-files/' . $pieceJointe->fk_id_uti;
           
            $uploadedFile = $request->file('file');
            if(!$uploadedFile) {
                return response()->json([
                    'message' => 'No file uploaded'
                ], 400);
            }

            switch ($request->input('type_pj')) {
                case ('IMAGE'):
                    $filePath .= '//image//';
                    break;
                case ('VIDEO'):
                    $filePath .= '//video//';
                    break;
                case ('PDF'):
                    $filePath .= '//pdf//';
                default:
                    break;
            }

            //TODO fill contenu with the path to the file
            //dont seem to work [edit : maybe after moving the file?]
            // $request->merge(['contenu_pj' => $filePath . $uploadedFile->getClientOriginalName()]);

            $fileName = $id . '_' . $uploadedFile->getClientOriginalName();
            $request->file->move(public_path($filePath), $fileName);
        }

        $pieceJointe->save();
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
        $pieceJointe = PieceJointe::findOrfail($idPieceJointe);

        $includes = request()->query('include');
        if ($includes) {
            $includedArray = explode(',', $includes);
            foreach ($includedArray as $include) {
                if (in_array($include, $this->allowedIncludes)) {
                    $pieceJointe = $pieceJointe->loadMissing($include);
                } else {
                    return response()->json([
                        'message' => 'Invalid include'
                    ], 400);
                }
            }
        }

        return new PieceJointeResource($pieceJointe);
    }

    /**
     * Launch download from an ID
     * 
     * @param int $idPieceJointe
     * @return file
     */
    public function download($idPieceJointe)
    {
        $pieceJointe = PieceJointe::findOrfail($idPieceJointe);

        if ($pieceJointe->type_pj == "ACTIVITE") {
            return response()->json([
                'message' => 'Activite isnt a valid type for download'
            ]);
        }

        $filePath = public_path() . $pieceJointe->contenu_pj;

        if(!file_exists($filePath)) {
            return response()->json([
                'message' => 'This piece jointe doesnt have any attachement'
            ], 404);
        }
        $fileMimeType = mime_content_type($filePath);

        //File mimes : png, jpg, jpeg, gif, mp4, webm, pdf'
        header('Content-Type: ' . $fileMimeType);
        header('Content-Disposition: attachment; filename="filename.extension"');

        return response()->download($filePath);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_pj
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pj)
    {
        $groupe = PieceJointe::findOrfail($id_pj);
        $groupe->delete($id_pj);

        return response()->json([
            'message' => 'Piece jointe deleted'
        ], 200);
    }
}
