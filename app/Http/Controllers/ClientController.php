<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        return view('Clients.clients', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'nip' => 'required|unique:clients,nip',
            'regon' => 'nullable|unique:clients,regon',
            'krs' => 'nullable|unique:clients,krs',
            'owner_first_name' => 'nullable|max:255',
            'owner_last_name' => 'nullable|max:255',
            'owner_email' => 'nullable|email|max:255',
            'owner_phone' => 'nullable|max:255',
        ]);

        $client = new Client([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'nip' => $request->get('nip'),
            'regon' => $request->get('regon'),
            'krs' => $request->get('krs'),
            'owner_first_name' => $request->get('owner_first_name'),
            'owner_last_name' => $request->get('owner_last_name'),
            'owner_email' => $request->get('owner_email'),
            'owner_phone' => $request->get('owner_phone'),
        ]);

        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        $projects = $client->projects()->get();
    
        return view('Clients.show', ['projectId' => $id, 'client' => $client, 'projects' => $projects]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        return view('Clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'nip' => [
                'required',
                'unique:clients,nip,'.$client->id.',id',
            ],
            'regon' => [
                'required',
                'unique:clients,regon,'.$client->id.',id',
            ],
            'krs' => [
                'nullable',
                'unique:clients,krs,'.$client->id.',id',
            ],
            'owner_first_name' => 'nullable|max:255',
            'owner_last_name' => 'nullable|max:255',
            'owner_email' => 'nullable|email|max:255',
            'owner_phone' => 'nullable|max:255',
        ]);
  
        $client->update($validatedData);
    
        return redirect()->route('clients.show', $id)->with('success', 'Employee position updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
    
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully!');
    }
}
