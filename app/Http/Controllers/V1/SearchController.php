<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\V1\SearchRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RessourceCollection;
use App\Http\Resources\V1\UtilisateurCollection;
use App\Models\Ressource;
use App\Models\Utilisateur;

class SearchController extends Controller
{
    protected $allowedIncludes = [
        'utilisateur',
        'categorie',
        'pieceJointe'
    ];

    /**
     * Search trough the database for a specific ressource or user
     *
     * @param SearchRequest $request
     * @return array
     */
    public function rechercher(SearchRequest $request)
    {
        $formatted = $request->formatted();

        $ressourcesResult = [];
        $utilisateursResult = [];

        //TODO refactor this
        if (isset($formatted['ressourceQuery'])) {
            $ressourceSearch = Ressource::where('titre_ressource', 'LIKE', "%{$formatted['ressourceQuery']}%")
                //->orWhere('contenu_texte_ressource', 'LIKE', "%{$formatted['ressourceQuery']}%")
                ->where('status', '=', "APPROVED")
                ->orderBy('date_publication_ressource', 'asc')
                ->take(25);

            $includes = $formatted['ressourceInclude'];
            if ($includes) {
                foreach ($includes as $includedRessource) {
                    if (in_array($includedRessource, $this->allowedIncludes)) {
                        $ressourceSearch->with($includedRessource);
                    } else {
                        return response()->json([
                            'message' => 'Invalid include'
                        ], 400);
                    }
                }
            }

            $ressourceSearch = $ressourceSearch->get();

            foreach ($ressourceSearch as $result) {
                array_push($ressourcesResult, $result);
            }
        }

        if (isset($formatted['utilisateurQuery'])) {
            $utilisateurSearch = Utilisateur::where('nom_uti', 'LIKE', "%{$formatted['utilisateurQuery']}%")
                ->orWhere('prenom_uti', 'LIKE', "%{$formatted['utilisateurQuery']}%")
                ->where('compte_actif_uti', '=', 1)
                ->take(25)
                ->get();

            foreach ($utilisateurSearch as $result) {
                array_push($utilisateursResult, $result);
            }
        }

        if (empty($ressourcesResult) && empty($utilisateursResult)) {
            return response(null, 204);
        }

        $utilisateurCollection = new UtilisateurCollection($utilisateursResult);
        $ressourceCollection = new RessourceCollection($ressourcesResult);

        // if one or the other is empty
        if (count($ressourceCollection) === 0) {
            return response()->json([
                'utilisateurs' => $utilisateurCollection,
            ], 200);
        }

        if (count($utilisateurCollection) === 0) {
            return response()->json([
                'ressources' => $ressourceCollection,
            ], 200);
        }

        // if both are full
        return response()->json([
            'ressources' => $ressourceCollection,
            'utilisateurs' => $utilisateurCollection,
        ], 200);
    }
}
