<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $items = Agent::latest()->paginate(15);

        return view('Admin.agents.index', compact('items'));
    }


    public function create()
    {
        return view('Admin.agents.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Agent::create($data);

        return redirect()
            ->route('admin.agents.index')
            ->with('success', 'Agent created successfully.');
    }


    public function show(Agent $agent)
    {
        return view('Admin.agents.show', [
            'item' => $agent
        ]);
    }


    public function edit(Agent $agent)
    {
        return view('Admin.agents.edit', [
            'item' => $agent
        ]);
    }


    public function update(Request $request, Agent $agent)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $agent->update($data);

        return redirect()
            ->route('admin.agents.index')
            ->with('success', 'Agent updated successfully.');
    }


    public function destroy(Agent $agent)
    {
        $agent->delete();

        return redirect()
            ->route('admin.agents.index')
            ->with('success', 'Agent deleted successfully.');
    }
}