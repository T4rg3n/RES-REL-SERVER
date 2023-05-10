<?php

namespace App\Http\Controllers\V1;

use App\Models\PieceJointe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PieceJointeResource;
use App\Http\Resources\V1\PieceJointeCollection;
use App\Http\Requests\V1\StorePieceJointeRequest;
use App\Services\V1\QueryService;
use Illuminate\Support\Facades\File;

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
        [$fieldOrder, $typeOrder] = (new QueryService())->translateOrderBy($request->query('orderBy'), 'id_piece_jointe', $this->columnMap);
        $piecesJointes = PieceJointe::where($eloquentQuery)->orderBy($fieldOrder, $typeOrder);

        $include = (new QueryService())->include(request(), $this->allowedIncludes);
        if ($include) {
            $piecesJointes->with($include);
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
            if (!$uploadedFile) {
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
                    // no break
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

        $include = (new QueryService())->include(request(), $this->allowedIncludes);
        if ($include) {
            $pieceJointe->loadMissing($include);
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
            return response()->json(['message' => 'Activite isnt a valid type for download']);
        }

        $path = null;

        if (config('app.debug') && $pieceJointe->contenu_pj == 'fake file') {
            $fileTypes = [
                'IMAGE' => ['png', 'jpg', 'jpeg', 'gif'],
                'VIDEO' => ['mp4'],
                'PDF'   => ['pdf'],
            ];

            if (array_key_exists($pieceJointe->type_pj, $fileTypes)) {
                //FIXME files arent found
                $path = public_path('assets/fake-' . strtolower($pieceJointe->type_pj) . 's');
                $files = File::files($path);
                $filteredFiles = array_filter($files, function ($file) use ($fileTypes, $pieceJointe) {
                    return in_array(File::extension($file), $fileTypes[$pieceJointe->type_pj]);
                });

                $fileCount = count($filteredFiles);
                if ($fileCount > 0) {
                    $filePath = $filteredFiles[$pieceJointe->id_piece_jointe % $fileCount];
                    $path = $filePath->getRealPath();
                }
            }
        } else {
            $filePath = public_path() . $pieceJointe->contenu_pj;

            if (!File::exists($filePath)) {
                return response()->json(['message' => 'This piece jointe doesnt have any attachement'], 404);
            }

            $path = $filePath;
        }

        $response = response();

        return $response->download($path);
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
