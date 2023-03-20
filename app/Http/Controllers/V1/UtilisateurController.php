<?php

namespace App\Http\Controllers\V1;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UtilisateurResource;
use App\Http\Resources\V1\UtilisateurCollection;
use App\Http\Requests\V1\StoreUtilisateurRequest;
use App\Http\Requests\V1\BanUtilisateurRequest;
use App\Services\V1\QueryFilter;

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
        'cheminPhoto' => ['equals'],
        'urlProfil' => ['equals'],
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
        'cheminPhoto' => 'photo_uti',
        'urlProfil' => 'url_profil_uti',
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
        $filter = new QueryFilter();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $utilisateurs = Utilisateur::where($eloquentQuery);

        $includes = $request->query('include');
        if ($includes) {
            $includedArray = explode(',', $includes);
            foreach ($includedArray as $include) {
                if (in_array($include, $this->allowedIncludes)) {
                    $utilisateurs->with($include);
                } else {
                    return response()->json([
                        'message' => 'Invalid include parameter'
                    ], 400);
                }
            }
        }
        
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
        $utilisateur->save();
        $id = $utilisateur->id_uti;

        return response()->json($this->show($id), 201);
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

        $includes = request()->query('include');
        if ($includes) {
            $includedArray = explode(',', $includes);
            foreach ($includedArray as $include) {
                if (in_array($include, $this->allowedIncludes)) {
                    $utilisateur = $utilisateur->loadMissing($include);
                } else {
                    return response()->json([
                        'message' => 'Invalid include parameter'
                    ], 400);
                }
            }
        }

        return new UtilisateurResource($utilisateur);
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
            'message' => 'Utilisateur deleted successfully'
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
