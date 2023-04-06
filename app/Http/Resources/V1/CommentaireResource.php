<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentaireResource extends JsonResource
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
            'id' => $this->id_commentaire,
            'contenu' => $this->contenu_commentaire,
            'datePublication' => $this->date_publication_commentaire,
            'nombreReponses' => $this->nombre_reponses_commentaire,
            'supprime' => $this->commentaire_supprime,
            'nombreSignalements' => $this->nombre_signalement_commentaire,
            'idUtilisateur' => $this->fk_id_uti,
            'utilisateur' => new UtilisateurResource($this->whenLoaded('utilisateur')),
            'idRessource' => $this->fk_id_ressource,
            'ressource' => new RessourceResource($this->whenLoaded('ressource')),
        ];   
    }
}