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
        [$fieldOrder, $typeOrder] = (new QueryService)->translateOrderBy($request->query('orderBy'), 'id_piece_jointe', $this->columnMap);
        $piecesJointes = PieceJointe::where($eloquentQuery)->orderBy($fieldOrder, $typeOrder);

        $include = (new QueryService)->include(request(), $this->allowedIncludes);
        if ($include)
            $piecesJointes->with($include);


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

        $include = (new QueryService)->include(request(), $this->allowedIncludes);
        if ($include)
            $pieceJointe->loadMissing($include);


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

        $path = null;
        $fileMimeType = null;

        //For debug mode, we use fake files (fake file is a file generated by the faker library)
        if (config('app.debug') && $pieceJointe->contenu_pj == 'fake file') {
            switch ($pieceJointe->type_pj) {
                case 'IMAGE':
                    $path = public_path('assets/fake-images');
                    $files = File::files($path);
                    $imageFiles = array_filter($files, function ($file) {
                        return in_array(File::extension($file), ['png', 'jpg', 'jpeg', 'gif']);
                    });
        
                    $fileCount = count($imageFiles);
                    if ($fileCount > 0) {
                        //modulus allows us to get a deterministic random number for a given id
                        $imagePath = $imageFiles[$pieceJointe->id_piece_jointe % $fileCount];
                        $fileMimeType = mime_content_type($imagePath->getRealPath());
                        $path = $imagePath->getRealPath();
                    }
                    break;
                case 'VIDEO':
                    $path = public_path('assets/fake-videos');
                    $files = File::files($path);
                    $videoFiles = array_filter($files, function ($file) {
                        return in_array(File::extension($file), ['mp4']);
                    });

                    $fileCount = count($videoFiles);
                    if ($fileCount > 0) {
                        $videoPath = $videoFiles[$pieceJointe->id_piece_jointe % $fileCount];
                        $fileMimeType = mime_content_type($videoPath->getRealPath());
                        $path = $videoPath->getRealPath();
                    }
                    break;
                case 'PDF':
                    $path = public_path('assets/fake-pdfs');
                    $files = File::files($path);
                    $pdfFiles = array_filter($files, function ($file) {
                        return in_array(File::extension($file), ['pdf']);
                    });

                    $fileCount = count($pdfFiles);
                    if ($fileCount > 0) {
                        $pdfPath = $pdfFiles[$pieceJointe->id_piece_jointe % $fileCount];
                        $fileMimeType = mime_content_type($pdfPath->getRealPath());
                        $path = $pdfPath->getRealPath();
                    }
                    break;
                default:
                    break;
            }
           /*  if ($pieceJointe->type_pj == "IMAGE") {

                $path = public_path('assets/fake-images');
                $files = File::files($path);
                $jpgFiles = array_filter($files, function ($file) {
                    return File::extension($file) === 'png';
                });

                $fileCount = count($jpgFiles);
                // return response()->json([
                //     'path' => $path,
                //     'message' => $fileCount
                // ]);

                if($fileCount > 0) {
                    $filePath = $jpgFiles[array_rand($jpgFiles)];
                    $fileMimeType = mime_content_type($filePath);
                }
            }

            if ($pieceJointe->type_pj == "VIDEO") {
                $fakeVideos = glob(public_path('assets/fake-videos/*.mp4'));
                if (!empty($fakeVideos)) {
                    $filePath = $fakeVideos[array_rand($fakeVideos)];
                    $fileMimeType = mime_content_type($filePath);
                }
            }

            if ($pieceJointe->type_pj == "PDF") {

                $fakePdfs = glob(public_path('assets/fake-pdfs/*.pdf'));
                if (!empty($fakePdfs)) {
                    $filePath = $fakePdfs[array_rand($fakePdfs)];
                    $fileMimeType = mime_content_type($filePath);
                }
            } */
        } else {
           /*  return response()->json([
                'message' => 'This feature is only available in debug mode'
            ], 400); */

            //TODO calculate the path to the file without using the database
            $filePath = public_path() . $pieceJointe->contenu_pj;

            if (!file_exists($filePath)) {
                return response()->json([
                    'message' => 'This piece jointe doesnt have any attachement'
                ], 404);
            }

            //File mimes : png, jpg, jpeg, gif, mp4, webm, pdf'
            $fileMimeType = mime_content_type($filePath);
        }

        header('Content-Type: ' . $fileMimeType);
        header('Content-Disposition: attachment; filename="filename.extension"');

        return response()->download($path);
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
