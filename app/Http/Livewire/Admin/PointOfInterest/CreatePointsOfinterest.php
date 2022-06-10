<?php

namespace App\Http\Livewire\Admin\PointOfInterest;

use App\Models\Place;
use App\Models\PointOfInterest;
use Livewire\Component;
use function view;

class CreatePointsOfinterest extends Component
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
        'createForm.distance' => 'required',
        'createForm.latitude' => 'required',
        'createForm.longitude' => 'required|exist:places,id',
        'createForm.place' => 'required',
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

        $point = PointOfInterest::create([
            'distance' => $this->createForm['distance'],
            'latitude' => $this->createForm['latitude'],
            'longitude' => $this->createForm['longitude'],
            'place_id' => $this->createForm['place'],
        ]);

        $this->reset('createForm');
        $this->emit('PointCreated');
        $this->emitTo('admin.pointsofinterest.show-points-ofinterest', 'render');
    }

    public function render()
    {
        return view('livewire.delete-points-ofinterest');
    }
}
