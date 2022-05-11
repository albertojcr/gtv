<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePhotographiesRequest;
use App\Models\Photography;
use App\Models\PointOfInterest;
use App\Models\ThematicArea;
use App\Models\User;
use Illuminate\Http\Request;

class PhotographiesController extends Controller
{
    public function index()
    {
        $photographies = Photography::allowed()->get();
        return view('admin.photographies.index', compact('photographies'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Photography());

        $this->validate($request, [
           'name' => 'required'
        ], [
            'name.required' => 'El nombre de la foto es requerido',
        ]);

        $photography = Photography::create($request->all());

        return redirect()->route('admin.photographies.edit', compact('photography'))->with('flash', 'La fotografia ha sido registrada correctamente');
    }

    public function show(Photography $photography)
    {
        $this->authorize('view', $photography);
        return view('admin.photographies.show', compact('photography'));
    }

    public function edit(Photography $photography)
    {
        $this->authorize('update', $photography);

        $users = User::all();
        $thematic_areas = ThematicArea::all();
        $pointsOfInterest = PointOfInterest::all();
        return view('admin.photographies.edit', compact('photography','pointsOfInterest', 'users', 'thematic_areas'));
    }

    public function update(UpdatePhotographiesRequest $request, Photography $photography)
    {
        $this->authorize('update', $photography);

        $photography->update($request->all());

        return redirect()->route('admin.photographies.index', compact('photography'))->with('flash', 'La fotografía ' . $photography->name . ' ha sido actualizada correctamente');
    }

    public function destroy(Photography $photography)
    {
        $this->authorize('delete', $photography);

        $photography->delete();

        return redirect()->route('admin.photographies.index')->with('flash', 'La fotografia ' . $photography->name . ' ha sido borrada correctamente');
    }
}
