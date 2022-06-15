<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThematicArea;
use Illuminate\Http\Request;

class ThematicAreasController extends Controller
{
    public function index()
    {
        $this->authorize('view', new ThematicArea());

        $thematicareas = ThematicArea::all();

        return view('admin.thematicareas.index', compact('thematicareas'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new ThematicArea());
        $this->validate($request, [
            'name' => 'required | max:245'
        ], [
        'name.required' => 'El nombre de area tematica es requerido',
            'name.max' => 'Tamaño maximo 245 caracteres'
        ]);

        $thematicarea = ThematicArea::create($request->all());

        return redirect()->route('admin.thematicareas.edit', compact('thematicarea'))->with('flash', 'El area tematica ha sido creado correctamente');
    }

    public function show(ThematicArea $thematicarea)
    {
        return view('admin.thematicareas.show', compact('thematicarea'));
    }

    public function edit(ThematicArea $thematicarea)
    {
        $this->authorize('update', $thematicarea);
        return view('admin.thematicareas.edit', compact('thematicarea'));
    }

    public function update(Request $request, ThematicArea $thematicarea)
    {
        $this->authorize('update', $thematicarea);
        $this->validate($request, [
            'name' => 'required | max:45',
            'description' => 'required | max:245'
        ], [
            'name.required' => 'El nombre de area tematica es requerido',
            'name.max' => 'Tamaño maximo 245 caracteres',
            'description.required' => 'La descripcion es requerida',
            'description.max' => 'Tamaño maximo 245 caracteres'
        ]);

        $thematicarea->update($request->all());

        return redirect()->route('admin.thematicareas.index', compact('thematicarea'))->with('flash', 'El area tematica ' . $thematicarea->name . ' ha sido editado correctamente');
    }

    public function destroy(ThematicArea $thematicarea)
    {
        $this->authorize('delete', $thematicarea);

        $thematicarea->delete();

        return redirect()->route('admin.thematicareas.index')->with('flash', 'El area tematica ' . $thematicarea->name . ' ha sido borrado correctamente');
    }
}
