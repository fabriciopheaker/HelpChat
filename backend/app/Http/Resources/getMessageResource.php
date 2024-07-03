<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class getMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'ID_MSG' => $this->id,
            'MSG' => $this->MSG,
            'ID_USER' => $this->ID_USER,
            'NOME' => $this->NOME,
            'HORARIO' => Carbon::parse($this->created_at)->format('H:i'),
            'AUTHOR' => false,
        ];
        return parent::toArray($request);
    }
}
