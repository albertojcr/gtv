<?php

namespace App\Http\Livewire\Admin\PointOfInterest;

use App\Models\Place;
use App\Models\PointOfInterest;
use Livewire\Component;
use function view;

class EditPointsOfinterest extends Component
{
    public $distance, $latitude, $longitude;
    public $place = [], $creator = '';

    protected $listeners = ['openEditModal'];

    public $editForm = [
        'open' => false,
        'distance' => '',
        'latitude' => '',
        'longitude' => '',
        'place_id' => '',
        'creator' => '',
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

    public function openEditModal(PointOfInterest $video)
    {
        $this->reset(['editForm']);

        $this->videoId = $video->id;
        $this->videoRoute = Storage::url($video->route);
        $this->editForm['pointOfInterest'] = $video->pointOfInterest->id;
        $this->editForm['thematicArea'] = $video->thematicArea->id;
        $this->editForm['description'] = $video->description;

        $this->getPlaces();

        $this->editForm['open'] = true;
    }

    public function getPlaces()
    {
        $this->place = Place::all();
    }

    public function update(Video $video)
    {
        $this->validate();

        $video->update([
            'updater' => auth()->user()->id,
            'point_of_interest_id' => $this->editForm['pointOfInterest'],
            'thematic_area_id' => $this->editForm['thematicArea'],
            'description' => $this->editForm['description'],
        ]);

        $this->editForm['open'] = false;
        $this->reset(['editForm']);

        $this->emitTo('admin.video.list-videos', 'render');
        $this->emit('videoUpdated');
    }

    public function render()
    {
        return view('livewire.edit-points-ofinterest');
    }
}
