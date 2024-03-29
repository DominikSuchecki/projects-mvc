<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role == 'admin'){
            $projects = Project::all();
        }
        else{
            $projects = Auth::user()->projects;
        }

        return view('Projects.projects', ['projects' => $projects]);
    }

    public function assignView(string $id)
    {
      $project = Project::findOrFail($id);
      $employees = $project->users()->get();
      $users = User::all();
    
      return view('Projects.assign', ['projectId' => $id, 'users' => $users, 'employees' => $employees]);
    }
    

    public function assign(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);
        $validatedData = $request->validate([
            'assigned_users' => 'required|array|min:1',
            'assigned_users.*' => 'integer|exists:users,id',
        ]);

        $project->users()->attach($validatedData['assigned_users']);

        return redirect()->back()->with(['success' => 'Employees assigned to project successfully!']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('projects.create', ['clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'name' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required'
        ]);

        $project = new Project([
            'client_id' => $request->get('client_id'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'status' => $request->get('status'),
        ]);

        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with('tasks')->findOrFail($id);
        return view('projects.show', ['project' => $project]);
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
