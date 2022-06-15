<?php

namespace App\Http\Livewire\Admin\Video;

use App\Jobs\ProcessVideo;
use App\Jobs\ProcessVideoItem;
use App\Models\PointOfInterest;
use App\Models\Video;
use App\Models\VideoItem;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVideo extends Component
{
    use WithFileUploads;

    public $pointsOfInterest = [], $thematicAreas = [], $order = 1;
    public $videoTemporaryUrl;

    protected $listeners = ['openCreationModal'];

    public $createForm = [
        'open' => false,
        'file' => null,
        'pointOfInterest' => '',
        'thematicArea' => '',
        'description' => '',
    ];

    protected $rules = [
        'createForm.file' => 'required',
        'createForm.pointOfInterest' => 'required',
        'createForm.thematicArea' => 'required|exists:thematic_areas,id',
        'createForm.description' => 'required|string|max:2000',
    ];

    protected $validationAttributes = [
        'createForm.file' => 'archivo',
        'createForm.pointOfInterest' => 'punto de interés',
        'createForm.thematicArea' => 'área temática',
        'createForm.description' => 'descripción',
    ];

    public function openCreationModal()
    {
        $this->createForm['open'] = true;
        $this->getPointsOfInterest();
    }

    public function getPointsOfInterest()
    {
        $this->pointsOfInterest = PointOfInterest::all();
    }

    public function getThematicAreas()
    {
        $selectedPointOfInterest = PointOfInterest::find($this->createForm['pointOfInterest']);
        $this->thematicAreas = $selectedPointOfInterest->thematicAreas;
    }

    public function updatedCreateFormFile()
    {
        $this->videoTemporaryUrl = $this->createForm['file']->temporaryUrl();
    }

    public function updatedCreateFormPointOfInterest()
    {
        $this->reset('order');
        $this->createForm['thematicArea'] = '';
        $this->setVideoOrder();
        $this->getThematicAreas();
    }

    public function setVideoOrder()
    {
        $videos = PointOfInterest::find($this->createForm['pointOfInterest'])->videos;

        if (count($videos) > 0) {
            $this->order = \count($videos) + 1;
        }
    }

    public function save()
    {
        $this->validate();

        $fileRoute = $this->createForm['file']->store('public/videos');

        $video = Video::create([
            'route' => $fileRoute,
            'point_of_interest_id' => $this->createForm['pointOfInterest'],
            'order'=> $this->order,
            'creator' => auth()->user()->id,
            'updater' => null,
            'thematic_area_id' => $this->createForm['thematicArea'],
            'description' => $this->createForm['description'],
        ]);

        ProcessVideo::dispatch($video);

        $videoItem = VideoItem::create([
            'video_id' => $video->id,
        ]);

        ProcessVideoItem::dispatch($videoItem);

        $this->reset('videoTemporaryUrl');
        $this->reset('createForm');
        $this->emit('videoCreated');
        $this->emitTo('admin.video.list-videos', 'render');
    }

    public function render()
    {
        return view('livewire.admin.video.create-video');
    }
}
