<?php

namespace App\Http\Livewire\Admin\Point;

use App\Models\Place;
use App\Models\PointOfInterest;
use Livewire\Component;
use function view;

class EditPoint extends Component
{
    public $distance, $latitude, $longitude, $pointId;
    public $places = [];

    protected $listeners = ['openEditModal'];

    public $editForm = [
        'open' => false,
        'distance' => '',
        'latitude' => '',
        'longitude' => '',
        'place' => '',
    ];

    protected $rules = [
        'editForm.distance' => 'required|numeric',
        'editForm.latitude' => 'required|numeric',
        'editForm.longitude' => 'required|numeric',
        'editForm.place' => 'required|exists:places,id',
    ];

    protected $validationAttributes = [
        'editForm.distance' => 'distancia',
        'editForm.latitude' => 'latitud',
        'editForm.longitude' => 'longitud',
        'editForm.place' => 'sitio',
    ];

    public function openEditModal(PointOfInterest $point)
    {
        $this->reset(['editForm']);

        $this->pointId = $point->id;
        $this->editForm['distance'] = $point->distance ;
        $this->editForm['latitude'] = $point->latitude;
        $this->editForm['longitude'] = $point->longitude;
        $this->editForm['place'] = $point->place->id;

        $this->getPlaces();

        $this->editForm['open'] = true;
    }

    public function getPlaces()
    {
        $this->places = Place::all();
    }

    public function update(PointOfInterest $point)
    {
        $this->validate();

        $point->update([
            'updater' => auth()->user()->id,
            'distance' => $this->editForm['distance'],
            'latitude' => $this->editForm['latitude'],
            'longitude' => $this->editForm['longitude'],
            'place_id' => $this->editForm['place'],
        ]);

        $this->editForm['open'] = false;
        $this->reset(['editForm']);

        $this->emitTo('admin.point.show-point', 'render');
        $this->emit('pointUpdated');
    }

    public function render()
    {
        return view('livewire.admin.point.edit-point');
    }
}
