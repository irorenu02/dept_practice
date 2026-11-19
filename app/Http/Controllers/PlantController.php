<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index(Request $request)
    {
        // Display only plants belonging to the logged-in user.
        $plants = $request->user()->plants()->latest()->get();

        return view('plants.index', compact('plants'));
    }

    // Show the form for creating a plant.
    public function create()
    {
        return view('plants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plant_name' => 'required|string|max:255',
            'category' => 'required|in:Ornamental,Flowering,Succulent,Herb',
            'unit_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock_status' => 'required|in:in_stock,out_of_stock',
        ]);

        // Automatically associate the authenticated creator.
        $request->user()->plants()->create($validated);

        return redirect()->route('plants.index')
            ->with('success', 'Plant created successfully!');
    }

    public function show(Plant $plant)
    {
        $this->checkOwnership($plant);

        return view('plants.show', compact('plant'));
    }

    // Show the edit form.
    public function edit(Plant $plant)
    {
        $this->checkOwnership($plant);

        return view('plants.edit', compact('plant'));
    }

    public function update(Request $request, Plant $plant)
    {
        $this->checkOwnership($plant);

        $validated = $request->validate([
            'plant_name' => 'required|string|max:255',
            'category' => 'required|in:Ornamental,Flowering,Succulent,Herb',
            'unit_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock_status' => 'required|in:in_stock,out_of_stock',
        ]);

        $plant->update($validated);

        return redirect()->route('plants.index')
            ->with('success', 'Plant updated successfully!');
    }

    public function destroy(Plant $plant)
    {
        $this->checkOwnership($plant);

        $plant->delete();

        return redirect()->route('plants.index')
            ->with('success', 'Plant deleted successfully!');
    }

    // Prevent users from accessing another user's plant.
    private function checkOwnership(Plant $plant)
{
    abort_unless(
        $plant->user_id == request()->user()->getAuthIdentifier(),
        404
    );
}
};