<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $project = Project::findOrFail($id);
        $employees = $project->users()->get();
        $users = User::all();
        
        return view('Tasks.create', ['projectId' => $id, 'users' => $users, 'employees' => $employees]);
    }

    public function assignView(string $id)
    {
      $task = Task::findOrFail($id);
      $employees = $task->users()->get();
      $users = $task->project->users;
    
      return view('tasks.assign', ['taskId' => $id, 'users' => $users, 'employees' => $employees]);
    }
    

    public function assign(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $validatedData = $request->validate([
            'assigned_users' => 'required|array|min:1',
            'assigned_users.*' => 'integer|exists:users,id',
        ]);

        $task->users()->attach($validatedData['assigned_users']);

        return redirect()->back()->with(['success' => 'Employees assigned to task!']);
    }

    public function unassign(Request $request, $taskId, $userId)
    {
        $task = Task::findOrFail($taskId);
        $user = User::findOrFail($userId);

        $task->users()->detach($userId);
    
        return redirect()->back()->with(['success' => 'User unassigned from Task!']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:backlog,in progress,to do,code review,done',
            'assigned_users' => 'nullable|array',
            'attachement_path' => 'nullable|mimes:zip,rar|max:50000',
        ]);

        $attachementPath = null;
        if ($request->hasFile('attachement_path')) {
            $file = $request->file('attachement_path');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $attachementPath = $file->storeAs('attachements', $fileName, 'public');
        }

        $task = Task::create([
            'project_id' => $id,
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'priority' => $validatedData['priority'],
            'status' => $validatedData['status'],
            'attachement_path' => $attachementPath,
        ]);

        $task->users()->attach($validatedData['assigned_users']);

        return redirect()->route('projects.show', $id)->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
