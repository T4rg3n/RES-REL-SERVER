<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\V1\SearchRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RessourceCollection;
use App\Http\Resources\V1\UtilisateurCollection;
use App\Models\Ressource;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Collection;

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
        $ressourcesResult = [];
        $utilisateursResult = [];

        if(isset($request->ressourceQuery)) {
            $ressourceSearch = Ressource::where('titre_ressource', 'LIKE', "%$request->ressourceQuery%")
            ->orWhere('contenu_texte_ressource', 'LIKE', "%$request->ressourceQuery%")
            ->where('status', '=', "APPROVED")
            ->orderBy('date_publication_ressource', 'asc')
            ->take(25)
            ->get();

            foreach($ressourceSearch as $result) {
                array_push($ressourcesResult, $result);
            }           
        }

        if(isset($request->utilisateurQuery)) {
            $utilisateurSearch = Utilisateur::where('nom_uti', 'LIKE', "%$request->utilisateurQuery%")
            ->orWhere('prenom_uti', 'LIKE', "%$request->utilisateurQuery%")
            ->where('compte_actif_uti', '=', 1)
            ->take(25)
            ->get();

            foreach($utilisateurSearch as $result) {
                array_push($utilisateursResult, $result);
            }
        }

        //if everything is empty return 204
        if(empty($ressourcesResult) && empty($utilisateursResult)) {
            return response(null, 204);
        }

        $utilisateurCollection = new UtilisateurCollection($utilisateursResult);
        $ressourceCollection = new RessourceCollection($ressourcesResult);

        //if one or the other is empty
        if($ressourceCollection->isEmpty())
            return $utilisateurCollection; 
        
        if($utilisateurCollection->isEmpty())
            return $ressourceCollection;
        

        //if both are full
        $finalCollection = $utilisateurCollection->concat($ressourceCollection);
        return $finalCollection;
    }
}
