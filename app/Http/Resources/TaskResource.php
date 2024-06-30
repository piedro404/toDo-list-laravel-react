<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "status" => $this->status,
            "concluied_at" => $this->concluied_at,
            "deadline" => $this->deadline,
            "created_at" => $this->created_at,
            "concluied_at_format" => $this->concluied_at ? [
                "date" => Carbon::parse($this->concluied_at)->format('d/m/Y'),
                "time" => Carbon::parse($this->concluied_at)->format("H:i"),
            ] : null,
            "deadline_format" => $this->deadline ? [
                "date" => Carbon::parse($this->deadline)->format('d/m/Y'),
                "time" => Carbon::parse($this->deadline)->format("H:i"),
            ] : null,
            "created_at_format" => $this->created_at ? [
                "date" => Carbon::parse($this->created_at)->format('d/m/Y'),
                "time" => Carbon::parse($this->created_at)->format("H:i"),
            ] : null,
            "term" => $this->deadline ?
                ($this->status ? "Concluído" : 
                    (Carbon::parse($this->deadline)->isPast() ? "Expirado" 
                        : "Termina " . Carbon::parse($this->deadline)->diffForHumans()))
                : null,
        ];
    }
}
