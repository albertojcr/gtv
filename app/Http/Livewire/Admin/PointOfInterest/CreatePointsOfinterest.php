<?php

namespace App\Http\Livewire\Admin\PointOfInterest;

use App\Models\Place;
use App\Models\PointOfInterest;
use Livewire\Component;
use function view;

class CreatePointsOfinterest extends Component
{

    public $distance, $latitude, $longitude;
    public $place = [], $creator = '';

    protected $listeners = ['openCreationModal'];

    public $createForm = [
        'open' => false,
        'distance' => null,
        'latitude' => null,
        'longitude' => null,
        'place_id' => null,
        'creator' => null,
    ];

    protected $rules = [
        'createForm.distance' => 'required',
        'createForm.latitude' => 'required',
        'createForm.longitude' => 'required',
        'createForm.place_id' => 'required',
        'createForm.creator' => 'required',
    ];

    protected $validationAttributes = [
        'createForm.distance' => 'distancia',
        'createForm.latitude' => 'latitud',
        'createForm.longitude' => 'longitud',
        'createForm.place_id' => 'sitio',
        'createForm.creator' => 'creador',
    ];

    public function openCreationModal()
    {
        $this->createForm['open'] = true;
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
        $point = new PointOfInterest();
        $point->distance = $this->distance;
        $point->latitude = $this->latitude;
        $point->longitude = $this->longitude;
        $point->place_id = $this->place_id;
        $point->creator = $this->creator;
        $point->save();

        return redirect()->route('admin.pointsofinterest.edit', $point);
    }

    public function render()
    {
        return view('livewire.delete-points-ofinterest');
    }
}
