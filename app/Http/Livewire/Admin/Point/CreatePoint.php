<?php

namespace App\Http\Livewire\Admin\Point;

use App\Models\Place;
use App\Models\PointOfInterest;
use Livewire\Component;
use function view;

class CreatePoint extends Component
{
    public $distance, $latitude, $longitude;
    public $places = [];

    protected $listeners = ['openCreationModal'];

    public $createForm = [
        'open' => false,
        'distance' => '',
        'latitude' => '',
        'longitude' => '',
        'place' => '',
    ];

    protected $rules = [
        'createForm.distance' => 'required|numeric',
        'createForm.latitude' => 'required|numeric',
        'createForm.longitude' => 'required||numeric',
        'createForm.place' => 'required|exist:places,id',
    ];

    protected $validationAttributes = [
        'createForm.distance' => 'distancia',
        'createForm.latitude' => 'latitud',
        'createForm.longitude' => 'longitud',
        'createForm.place' => 'sitio',
    ];

    public function openCreationModal()
    {
        $this->createForm['open'] = true;
        $this->getPlaces();
    }

    public function getPlaces()
    {
        $this->place = Place::all();
    }

    public function mount()
    {
        $this->places = Place::all();
    }

    public function save()
    {
        $this->validate();

        PointOfInterest::create([
            'distance' => $this->createForm['distance'],
            'latitude' => $this->createForm['latitude'],
            'longitude' => $this->createForm['longitude'],
            'place_id' => $this->createForm['place'],
            'creator' => auth()->user()->id,
            'updater' => null,
        ]);

        $this->reset('createForm');
        $this->emit('PointCreated');
        $this->emitTo('admin.point.show-point', 'render');
    }

    public function render()
    {
        return view('livewire.admin.point.create-point');
    }
}
