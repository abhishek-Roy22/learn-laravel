<?php

namespace App\Http\Controllers;

use App\Models\Ninja;
use App\Models\Dojo;
use Illuminate\Http\Request;

class NinjaController extends Controller
{
    public function index() {
        // route --> /ninjas/
        $ninjas = Ninja::with('dojo')->orderBy('created_at', 'desc')->paginate(10);
        // fetch all records & pass into the index view
        return view('ninjas.index', ["ninjas" => $ninjas]);
    }

    public function show(Ninja $ninja) {
        // route --> /ninjas/{id}
        // $ninja = Ninja::with('dojo')->findOrFail($id);
        $ninja->load('dojo');
        // fetch a single record & pass into show view

        return view('ninjas.show', ["ninja" => $ninja]);
    }

    public function create() {
        // route --> /ninjas/create
        $dojos = Dojo::all();

        return view('ninjas.create', ["dojos" => $dojos]);
    }

    public function store(Request $request) {
        // --> /ninjas/ (POST)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'skill' => 'required|integer|min:0|max:100',
            'bil' => 'required|string|min:20|max:1000',
            'dojo_id' => 'required|exists:dojos,id',
        ]);

        Ninja::create($validated);

        return redirect()->route('ninjas.index')->with('success', 'Ninja Created!');
    }

    public function destroy(Ninja $ninja) {
        //  --> /ninjas/{id} {delete}
        $ninja->delete();

        return redirect()->route('ninjas.index')->with('success', 'Ninja Deleted!');
    }
}

