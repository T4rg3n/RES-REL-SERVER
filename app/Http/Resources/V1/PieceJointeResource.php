<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PieceJointeResource extends JsonResource
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
            'id' => $this->id_piece_jointe,
            'type' => $this->type_pj,
            'titre' => $this->titre_pj,
            'dateCreation' => $this->date_creation_pj,
            'description' => $this->description_pj,
            'contenu' => $this->contenu_pj,
            'dateActivite' => $this->date_activite_pj,
            'lieu' => $this->lieu_pj,
            'codePostal' => $this->code_postal_pj,
            'utilisateur' => $this->fk_id_uti,
        ];
    }
}
