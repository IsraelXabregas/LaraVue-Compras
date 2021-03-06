<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller {
    public function index() {
        return Task::orderBy('completed', 'asc')->get();
    }

    public function store(Request $request) {
        $task = new Task();
        $task->name = $request->name;
        $task->save();

        return $task;
    }

    public function update(Request $request, $id) {
        $task = Task::findOrFail($id);
        $task->completed = $request->completed;
        $task->update();

        return $task;

    }

    public function destroy($id) {
        $task = Task::findOrFail($id);
        $task->delete();

        return 204;
    }
}
