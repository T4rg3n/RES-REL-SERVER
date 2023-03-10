<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class RessourceResource extends JsonResource
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
            'id' => $this->id_ressource,
            'dateCreation' => $this->date_creation_ressource,
            'status' => $this->status,
            'idUtilisateur' => $this->fk_id_uti,
            'partage' => $this->partage_ressource,
            'titre' => $this->titre_ressource,
            'contenu' => $this->contenu_texte_ressource,
            'datePublication' => $this->date_publication_ressource,
            'raisonRefus' => $this->raison_refus_ressource,
            'idCategorie' => $this->fk_id_categorie,
        ];
    }
}
