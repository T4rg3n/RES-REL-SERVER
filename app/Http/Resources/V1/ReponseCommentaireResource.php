<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ReponseCommentaireResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id_reponse,
            'contenu' => $this->contenu_reponse,
            'date' => $this->date_reponse,
            'supprime' => $this->reponse_supprime,
            'nombreSignalements' => $this->nombre_signalement_commentaire,
            'idUtilisateur' => $this->fk_id_uti,
            'idCommentaire' => $this->fk_id_commentaire,
            'datePublication' => $this->date_publication_reponse,
            'reponseSupprime' => $this->reponse_supprime,
        ];
    }
}
