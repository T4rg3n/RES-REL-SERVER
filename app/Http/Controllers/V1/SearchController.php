<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\V1\SearchRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RessourceCollection;
use App\Http\Resources\V1\UtilisateurCollection;
use App\Models\Ressource;
use App\Models\Utilisateur;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;

class SearchController extends Controller
{
    /**
     * Search trough the database for a specific ressource or user
     * 
     * @param SearchRequest $request
     * @return array
     */
    public function search(SearchRequest $request)
    {
        $result = [];
        $ressourceCollection = null;
        $utilisateurCollection = null;

        if(isset($request->ressourceQuery)) {
            $ressourceSearch = Ressource::where('titre_ressource', 'LIKE', "%$request->ressourceQuery%")
            ->orWhere('contenu_texte_ressource', 'LIKE', "%$request->ressourceQuery%")
            ->where('status', '=', "APPROVED")
            ->orderBy('date_publication_ressource', 'asc')
            ->take(25)
            ->get();

            foreach($ressourceSearch as $ressourceResult) {
                array_push($result, $ressourceResult);
            }

            $ressourceCollection = new RessourceCollection($result);
        }

        if(isset($request->utilisateurQuery)) {
            $utilisateurSearch = Utilisateur::where('nom_uti', 'LIKE', "%$request->utilisateurQuery%")
            ->orWhere('prenom_uti', 'LIKE', "%$request->utilisateurQuery%")
            ->where('compte_actif_uti', '=', 1)
            ->take(25)
            ->get();

            foreach($utilisateurSearch as $utilisateurResult) {
                array_push($result, $utilisateurResult);
            }

            $utilisateurCollection = new UtilisateurCollection($result);
        }

        if(empty($result)) {
            return response(204);
        }


        /** BUG array of empty users at the end of the response :
         * If there is n ressources, there will be n empty arrays at the end of the response.
         */
        $finalCollection = $ressourceCollection->merge($utilisateurCollection);
        return $finalCollection;
        //return response()->json($result, 200);
    }
}
