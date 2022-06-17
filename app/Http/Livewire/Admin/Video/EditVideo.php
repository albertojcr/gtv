<?php

namespace App\Http\Livewire\Admin\Video;

use App\Models\PointOfInterest;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class EditVideo extends Component
{
    public $pointsOfInterest = [], $thematicAreas = [];
    public $videoId, $videoRoute;

    protected $listeners = ['openEditModal'];

    public $editForm = [
        'open' => false,
        'pointOfInterest' => '',
        'thematicArea' => '',
        'description' => '',
    ];

    protected $rules = [
        'editForm.pointOfInterest' => 'required',
        'editForm.thematicArea' => 'required|exists:thematic_areas,id',
        'editForm.description' => 'required|string|max:2000',
    ];

    protected $validationAttributes = [
        'editForm.pointOfInterest' => 'punto de interés',
        'editForm.thematicArea' => 'área temática',
        'editForm.description' => 'descripción',
    ];

    public function openEditModal(Video $video)
    {
        $this->reset(['editForm']);

        $this->videoId = $video->id;
        $this->videoRoute = Storage::url($video->route);
        $this->editForm['pointOfInterest'] = $video->pointOfInterest->id ?? '';
        $this->editForm['thematicArea'] = $video->thematicArea->id ?? '';
        $this->editForm['description'] = $video->description;

        $this->getPointsOfInterest();
        $this->getThematicAreas();

        $this->editForm['open'] = true;
    }

    public function getPointsOfInterest()
    {
        $this->pointsOfInterest = PointOfInterest::all();
    }

    public function getThematicAreas()
    {
        if ( ! empty($this->thematicAreas)) {
            $selectedPointOfInterest = PointOfInterest::find($this->editForm['pointOfInterest']);
        } else {
            $selectedPointOfInterest = PointOfInterest::first();
        }
        $this->thematicAreas = $selectedPointOfInterest->thematicAreas;
    }

    public function updatedEditFormPointOfInterest()
    {
        $this->editForm['thematicArea'] = '';
        $this->getThematicAreas();
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
        return view('livewire.admin.video.edit-video');
    }
}
