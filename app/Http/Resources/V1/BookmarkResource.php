<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class BookmarkResource extends JsonResource
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
            'id' => $this->id_bookmark,
            'dateSauvegarde' => $this->date_bookmark,
            'idUtilisateur' => $this->fk_id_uti,
            'utilisateur' => new UtilisateurResource($this->whenLoaded('utilisateur')),
            'idRessource' => $this->fk_id_ressource,
            'ressource' => new RessourceResource($this->whenLoaded('ressource')),
        ];
    }
}
