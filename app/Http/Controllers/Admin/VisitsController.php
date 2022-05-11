<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVisitsRequest;
use App\Models\PointOfInterest;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitsController extends Controller
{
    public function index()
    {
        $visits = Visit::all();
        return view('admin.visits.index', compact('visits'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'deviceid' => 'required'
        ], [
            'deviceid.required' => 'El campo nombre de dispositivo es requerido'
        ]);

        $visit = Visit::create($request->all());

        return redirect()->route('admin.visits.edit', $visit)->with('flash', 'La visita ha sido creada correctamente');
    }

    public function show(Visit $visit)
    {
        return view('admin.visits.show', compact('visit'));
    }

    public function edit(Visit $visit)
    {
        $pointsOfInterest = PointOfInterest::all();

        return view('admin.visits.edit', compact('visit', 'pointsOfInterest'));
    }

    public function update(UpdateVisitsRequest $request, Visit $visit)
    {
        $visit->update($request->all());

        return redirect()->route('admin.visits.index', $visit)->with('flash', 'La visita ' . $visit->deviceid . ' ha sido actualizada correctamente');
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();

        return redirect()->route('admin.visits.index')->with('flash', 'La visita ' . $visit->deviceid . ' ha sido borrada correctamente');
    }
}
