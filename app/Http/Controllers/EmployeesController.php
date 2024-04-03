<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::get();
    
        return view('Employees.employees', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = User::with('projects')->findOrFail($id);
        return view('Employees.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = User::findOrFail($id);
    
        return view('Employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = User::findOrFail($id);
    
        $request->validate([
            'position' => 'required|string|in:ui designer,frontend,backend,fullstack,devops', // Add allowed positions here
        ]);
    
        $employee->position = $request->input('position');
        $employee->save();
    
        return redirect()->route('employees.show', $id)->with('success', 'Employee position updated successfully!');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();
    
        return redirect()->route('projects.show', $id)->with('success', 'Employee deleted successfully!');
    }
    
}
