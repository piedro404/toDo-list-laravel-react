<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($task) use ($request) {
                $taskResource = new TaskResource($task);
                $taskArray = $taskResource->toArray($request);
                
                $taskArray['urls'] = [
                    'url_show' => route('task.show', ['id' => $task->id]),
                    'url_edit' => route('task.edit', ['id' => $task->id]),
                    'url_delete' => route('task.destroy', ['id' => $task->id]),
                ];
                
                return $taskArray;
            })->all(),
        ];
    }
}
