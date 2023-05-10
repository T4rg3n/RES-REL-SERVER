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
        $ressourcesResult = $this->searchRessources($formatted);
        $utilisateursResult = $this->searchUtilisateurs($formatted);

        if (empty($ressourcesResult) && empty($utilisateursResult)) {
            return response(null, 204);
        }

        $utilisateurCollection = new UtilisateurCollection($utilisateursResult);
        $ressourceCollection = new RessourceCollection($ressourcesResult);

        $response = ['ressources' => $ressourceCollection, 'utilisateurs' => $utilisateurCollection];
        return response()->json($response, 200);
    }

    private function searchRessources($formatted)
    {
        if (!isset($formatted['ressourceQuery'])) {
            return [];
        }

        $ressourceSearch = Ressource::where('titre_ressource', 'LIKE', "%{$formatted['ressourceQuery']}%")
            ->where('status', '=', "APPROVED")
            ->orderBy('date_publication_ressource', 'asc')
            ->take(25);

        $includes = $formatted['ressourceInclude'];
        if ($includes) {
            foreach ($includes as $includedRessource) {
                if (!in_array($includedRessource, $this->allowedIncludes)) {
                    return response()->json(['message' => 'Invalid include'], 400);
                }
                $ressourceSearch->with($includedRessource);
            }
        }

        return $ressourceSearch->get();
    }

    private function searchUtilisateurs($formatted)
    {
        if (!isset($formatted['utilisateurQuery'])) {
            return [];
        }

        return Utilisateur::where('nom_uti', 'LIKE', "%{$formatted['utilisateurQuery']}%")
            ->orWhere('prenom_uti', 'LIKE', "%{$formatted['utilisateurQuery']}%")
            ->where('compte_actif_uti', '=', 1)
            ->take(25)
            ->get();
    }
}
