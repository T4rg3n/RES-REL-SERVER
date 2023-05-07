<?php

namespace App\Http\Controllers\V1;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UtilisateurResource;
use App\Http\Resources\V1\UtilisateurCollection;
use App\Http\Requests\V1\StoreUtilisateurRequest;
use App\Http\Requests\V1\BanUtilisateurRequest;
use App\Services\V1\QueryService;
use App\Services\V1\TokenAttributor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;

class UtilisateurController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'id' => ['equals'],
        'mail' => ['equals'],
        'dateInscription' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'dateNaissance' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'codePostal' => ['equals'],
        'nom' => ['equals'],
        'prenom' => ['equals'],
        'compteActif' => ['equals'],
        'role' => ['equals']
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'id' => 'id_uti',
        'mail' => 'mail_uti',
        'dateInscription' => 'date_inscription_uti',
        'dateNaissance' => 'date_naissance_uti',
        'codePostal' => 'code_postal_uti',
        'nom' => 'nom_uti',
        'prenom' => 'prenom_uti',
        'compteActif' => 'compte_actif_uti',
        'role' => 'fk_id_role'
    ];

    /**
     * Array of allowed includes
     */
    protected $allowedIncludes = [
        'role'
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
        $eloquentQuery = (new QueryService)->transform($queryContent, $this->allowedParams, $this->columnMap);
        
        // Order by
        [$fieldOrder, $typeOrder] = (new QueryService)->translateOrderBy($request->query('orderBy'), 'id_uti', $this->columnMap); 
        $utilisateurs = Utilisateur::where($eloquentQuery)->orderBy($fieldOrder, $typeOrder); 

        $include = (new QueryService)->include(request(), $this->allowedIncludes);
        if ($include)
            $utilisateurs->with($include);
        
        return new UtilisateurCollection($utilisateurs->paginate($perPage)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\StoreUtilisateurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUtilisateurRequest $request)
    {
        if(Utilisateur::where('mail_uti', $request->mail)->first()) {
            return response()->json([
                'message' => 'User with same email already exists'
            ], 401);
        }

        $utilisateur = Utilisateur::create($request->all());
       
        //users can optionally upload a photo
        if($request->hasFile('photoProfil')) {
            $filePath = 'user-files/' . $utilisateur->id_uti;
            $uploadedFile = $request->file('photoProfil');
            $utilisateur->photo_uti = $filePath;
    
            $fileName = $utilisateur->id_uti . "_photoProfil." . $uploadedFile->getClientOriginalExtension();
            $request->photoProfil->move(public_path($filePath), $fileName);
        } else {
            $utilisateur->photo_uti = public_path() . '/assets/default-assets/default-user.png';
        }
        
        $utilisateur->fk_id_role = 4;
        $utilisateur->save();

        $token = (new TokenAttributor)->createToken($utilisateur);
        $id = $utilisateur->id_uti;

        Mail::to('vic.gombert@gmail.com')->send(new RegistrationMail());

        return response()->json(['response' => $this->show($id), 'token' => $token], 201);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id_uti
     * @return \Illuminate\Http\Response
     */
    public function show($id_uti)
    {
        $utilisateur = Utilisateur::findOrfail($id_uti);

        $include = (new QueryService)->include(request(), $this->allowedIncludes);
        if ($include)
            $utilisateur->load($include);

        return new UtilisateurResource($utilisateur);
    }

    /**
     * Download the profile picture of the user if defined.
     * If it isnt it returns a default picture.
     * 
     * @param int $idUtilisateur
     */
    public function download($idUtilisateur)
    {
        $utilisateur = Utilisateur::findOrfail($idUtilisateur);
        $filePath = $utilisateur->photo_uti;
        
        //  $fileName = $utilisateur->id_uti . "_photoProfil." . pathinfo($filePath, PATHINFO_EXTENSION);
        //check if file exists

        //TODO refactor this
        if(file_exists(public_path() . $filePath)) {
            $fileMimeType = pathinfo($filePath, PATHINFO_EXTENSION);    
            header('Content-Type: image/' . $fileMimeType);
            //header('Content-Disposition: attachment; filename="filename.extension"');
            return response()->download(public_path() . $filePath);
        } else {
            if(config('app.debug') && $utilisateur->photo_uti == 'fake user photo'){
                //TODO determine user gender an return a fake profile picture
                $path = public_path() . '/assets/fake-profile-pictures/female';
                $files = File::files($path);
                $profilePictures = array_filter($files, function($file) {
                    return in_array(File::extension($file), ['png', 'jpg', 'jpeg', 'gif']);
                });

                $filePath = null;
                $fileCount = count($profilePictures);
                if($fileCount > 0) {
                    $imagePath = $profilePictures[$utilisateur->id_uti % $fileCount];
                    $fileMimeType = mime_content_type($imagePath->getRealPath());
                    $filePath = $imagePath->getRealPath();
                }

                header('Content-Type: image/' . $fileMimeType);
                header('Content-Disposition: attachment; filename="filename.extension"');
                return response()->download($filePath);
            } else {
                header('Content-Type: image/png');
                header('Content-Disposition: attachment; filename="filename.extension"');
                return response()->download(public_path() . '/assets/default-assets/default-user.png');
            }
        }
    }

    /**
     * Logout the specified user
     * 
     * @param Request request with idUser & bearer token
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_uti
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_uti)
    {
        $utilisateur = Utilisateur::findOrfail($id_uti);
        $utilisateur->delete();

        return response()->json([
            'message' => 'Utilisateur deleted'
        ], 200);
    }
    
    /**
     * Set the specified user as disabled (banned) in the database
     * 
     * @param int $id_uti
     * @return \Illuminate\Http\Response
     */
    public function disable(BanUtilisateurRequest $request)
    {
        $utilisateur = Utilisateur::findOrfail($request->id_uti);
        $utilisateur->compte_actif_uti = false;
        $utilisateur->raison_banni_uti = $request->raison_banni_uti;
        $utilisateur->save();
        $id = $utilisateur->id_uti;
        
        return response()->json([
            'message' => 'Utilisateur disabled',
        ], 200);
    }
}
