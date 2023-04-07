<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UtilisateurResource extends JsonResource
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
            'id' => $this->id_uti,
            'mail' => $this->mail_uti,
            'motDePasse' => $this->mdp_uti,
            'dateInscription' => $this->date_inscription_uti,
            'dateNaissance' => $this->date_naissance_uti,
            'codePostal' => $this->code_postal_uti,
            'nom' => $this->nom_uti,
            'prenom' => $this->prenom_uti,
            'cheminPhoto' => $this->photo_uti,
            'bio' => $this->bio_uti,
            'compteActif' => $this->compte_actif_uti,
            'raisonBan' => $this->raison_banni_uti,
            'idRole' => $this->fk_id_role,
            'role' => new RoleResource($this->whenLoaded('role')),
        ];
    }
}
