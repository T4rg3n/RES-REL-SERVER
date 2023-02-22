<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class FavorisResource extends JsonResource
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
            'id' => $this->id_favoris,
            'dateFav' => $this->date_fav,
            'idUtilisateur' => $this->fk_id_uti,
            'idRessource' => $this->fk_id_ressource,
        ];
    }
}
