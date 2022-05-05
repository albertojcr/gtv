<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePointsOfInterestRequest;
use App\Models\Place;
use App\Models\PointOfInterest;
use App\Models\ThematicArea;
use App\Models\User;
use Illuminate\Http\Request;

class PointsOfInterestController extends Controller
{
    public function index()
    {
        $pointsofinterests = PointOfInterest::allowed()->get();
        $users = User::all();
        return view('admin.pointsofinterest.index', compact('pointsofinterests','users'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new PointOfInterest());

        $this->validate($request, ['qr'=>'required'], [
            'qr.required' => 'El codigo qr es requerido'
        ]);

        $pointsofinterest = PointOfInterest::create($request->all());

        return redirect()->route('admin.pointsofinterest.edit', compact('pointsofinterest'))->with('flash', 'El punto de interés ha sido creado correctamente');
    }

    public function show(PointOfInterest $pointsofinterest)
    {
        return view('admin.pointsofinterest.show', compact('pointsofinterest'));
    }

    public function edit(PointOfInterest $pointsofinterest)
    {
        $this->authorize('update', $pointsofinterest);

        $thematicAreas=ThematicArea::all();
        $places = Place::all();

        return view('admin.pointsofinterest.edit', compact('pointsofinterest', 'places','thematicAreas'));
    }

    public function update(UpdatePointsOfInterestRequest $request, PointOfInterest $pointsofinterest)
    {
        $this->authorize('update', $pointsofinterest);

        $pointsofinterest->update([
            'qr' => $request->get('qr'),
            'distance' => $request->get('distance'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
            'place_id' => $request->get('place_id'),
        ]);

        $pointsofinterest->syncthematicAreas($request->thematicAreas, $request->title, $request->description, $request->language);

        return redirect()->route('admin.pointsofinterest.index', compact('pointsofinterest'))->with('flash', 'El punto de interés ' . $pointsofinterest->qr . ' ha sido editado correctamente');
    }

    public function destroy(PointOfInterest $pointsofinterest)
    {
        $this->authorize('delete', $pointsofinterest);

        $pointsofinterest->delete();

        return redirect()->route('admin.pointsofinterest.index')->with('flash', 'El punto de interés ' . $pointsofinterest->qr . ' ha sido borrado correctamente');;
    }
}
