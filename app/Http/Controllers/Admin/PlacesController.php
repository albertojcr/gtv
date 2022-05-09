<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function index()
    {
        $places = Place::allowed()->get();
        return view('admin.places.index', compact('places'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Place());

        $this->validate($request, [
            'name' => 'required | max:45'
        ], [
            'name.required' => 'El nombre del lugar es requerido',
            'name.max' => 'Tamaño invalido (maximo 45 caracteres)'
        ]);

        $place = Place::create($request->all());

        return redirect()->route('admin.places.edit', compact('place'))->with('flash', 'El lugar ha sido creado correctamente');
    }

    public function show(Place $place)
    {
        return view('admin.places.show', compact('place'));
    }

    public function edit(Place $place)
    {
        $this->authorize('update', $place);

        $users = User::all();
        $place_relation = Place::get();
        return view('admin.places.edit', compact('place', 'users', 'place_relation'));
    }

    public function update(Request $request, Place $place)
    {
        $this->authorize('update', $place);

        $this->validate($request, [
           'name' => 'required | max:45',
           'description' => 'required | max:45'
        ], [
            'name.required' => 'El nombre del lugar es requerido',
            'name.max' => 'Tamaño invalido (maximo 45 caracteres)',
            'description.required' => 'La descripcion es requerida',
            'description.max' => 'Tamaño de la descripcion invalido (maximo 45 caracteres)'
        ]);

        $place->updater = auth()->user()->id;

        $place->update($request->all());

        return redirect()->route('admin.places.index', compact('place'))->with('flash', 'El lugar ' . $place->name . ' ha sido actualizado correctamente');
    }

    public function destroy(Place $place)
    {
        $this->authorize('delete', $place);

        $place->delete();
        return redirect()->route('admin.places.index')->with('flash', 'El lugar ' . $place->name . ' ha sido borrado correctamente');
    }
}
