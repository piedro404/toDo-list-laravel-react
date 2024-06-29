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
            "concluied_at_format" => $this->concluied_at ? Carbon::parse($this->concluied_at)->format('d/m/Y') : null,
            "deadline_format" => $this->deadline ? Carbon::parse($this->deadline)->format('d/m/Y') : null,
            "created_at_format" => $this->created_at ? Carbon::parse($this->created_at)->format('d/m/Y') : null,
            "term" => $this->deadline ? Carbon::parse($this->deadline)->diffForHumans() : null,
        ];
    }
}
