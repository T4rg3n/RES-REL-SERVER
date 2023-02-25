<?php

namespace App\Http\Controllers\V1;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UtilisateurResource;
use App\Http\Resources\V1\UtilisateurCollection;
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
        $utilisateurs = Utilisateur::where($eloquentQuery)->paginate();

        return new UtilisateurCollection($utilisateurs->appends($request->query()));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id_uti
     * @return \Illuminate\Http\Response
     */
    public function show($id_uti)
    {
        $utilisateur = Utilisateur::where('id_uti', $id_uti)->first();

        return new UtilisateurResource($utilisateur);
    }
    
}
