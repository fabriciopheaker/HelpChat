<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllMsgsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $idUser = $request->user()->id;
        return [
            'ID_MSG' => $this->ID_MSG,
            'MSG' => $this->MSG,
            'ID_USER' => $this->ID_USER,
            'NOME' => $this->NOME,
            'HORARIO' => Carbon::parse($this->created_at)->format('H:i'),
            'AUTHOR' => $this->ID_USER === $idUser,
        ];

        return parent::toArray($request);
    }
}
