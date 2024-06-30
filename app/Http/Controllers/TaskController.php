<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskFormRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private $user;
    private $task;

    public function __construct(User $user, Task $task)
    {
        $this->user = $user;
        $this->task = $task;
    }

    public function index()
    {
        $auth = Auth::user();
        $user = $this->user->find($auth->id);
        $tasks = new TaskResourceCollection($user->tasks()->get());
        // dd($tasks);

    
        return Inertia::render("Task/Index", ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Task/Create", ["urls" => ["url_store" => Route("task.store")]]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskFormRequest $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $user = $this->user->find($auth->id);
        $request['status'] = false;
        $user->tasks()->create($request->all());

        return redirect()->route("task.index")->with("success", "Tarefa " . $request['title'] . " criada com sucesso!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $auth = Auth::user();
        $user = $this->user->find($auth->id);
        $task = $user->tasks()->find($id);
        if ($task == null) {
            return redirect()->route("task.index")->with("error", "Tarefa não encontrada!");
        }
        $task = new TaskResource($task);
        // dd($task);
        return Inertia::render("Task/Show", ['task' => $task, "urls" => ['url_edit' => Route('task.edit', ['id' => $task->id]), 'url_delete' => Route('task.destroy', ['id' => $task->id])]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $auth = Auth::user();
        $user = $this->user->find($auth->id);
        $task = $user->tasks()->find($id);
        if ($task == null) {
            return redirect()->route("task.index")->with("error", "Tarefa não encontrada!");
        }
        $task = new TaskResource($task);
        // dd($task);
        return Inertia::render("Task/Edit", ['task' => $task, "urls" => ['url_update' => Route('task.update', ['id' => $task->id])]]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskFormRequest $request, string $id)
    {
        $auth = Auth::user();
        $user = $this->user->find($auth->id);
        $task = $user->tasks()->find($id);

        if ($task == null) {
            return redirect()->route("task.index")->with("error", "Tarefa não encontrada!");
        }

        if ($request->status != $task->status) {
            if ($request->status) {
                $request['concluied_at'] = Carbon::now();
            } else {
                $request['concluied_at'] = null;
            }
        }
        // dd($request->all(), $id);

        $task->update($request->all());

        return redirect()->route("task.index")->with("success", "Tarefa " . $request['title'] . " atualizada com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $auth = Auth::user();
        $user = $this->user->find($auth->id);
        $task = $user->tasks()->find($id);

        if ($task == null) {
            return redirect()->route("task.index")->with("error", "Tarefa não encontrada!");
        }

        $task->delete();

        return redirect()->route("task.index")->with("success", "Tarefa " . $task['title'] . " excluida com sucesso!");
    }
}
