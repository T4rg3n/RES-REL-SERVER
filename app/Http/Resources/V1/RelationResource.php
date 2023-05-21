<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class RelationResource extends JsonResource
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
            'id' => $this->id_relation,
            'idTypeRelation' => $this->fk_id_type_relation,
            'typeRelation' => new TypeRelationResource($this->whenLoaded('typeRelation')),
            'idDemandeur' => $this->demandeur_id,
            'demandeur' => new UtilisateurResource($this->whenLoaded('demandeur')),
            'idReceveur' => $this->receveur_id,
            'receveur' => new UtilisateurResource($this->whenLoaded('receveur')),
            'dateDemande' => $this->date_demande,
            'dateAcceptation' => $this->date_acceptation,
            'accepte' => $this->accepte,
        ];
    }
}
