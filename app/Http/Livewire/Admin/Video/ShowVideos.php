<?php

namespace App\Http\Livewire\Admin\Video;

use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ShowVideos extends Component
{
    use WithPagination;

    public $listeners = ['delete'];

    public $detailsModal = [
        'open' => false,
        'id' => null,
        'description' => null,
        'route' => null,
        'order' => null,
        'pointOfInterest' => null,
        'thematicAreaName' => null,
        'thematicAreaId' => null,
        'creatorName' => null,
        'creatorId' => null,
        'updaterName' => null,
        'updaterId' => null,
        'createdAt' => null,
        'updatedAt' => null,
    ];

    public function show(Video $video)
    {
        $this->detailsModal['open'] = true;
        $this->detailsModal['id'] = $video->id;
        $this->detailsModal['description'] = $video->description;
        $this->detailsModal['route'] = Storage::url($video->route);
        $this->detailsModal['order'] = $video->order;
        $this->detailsModal['pointOfInterest'] = $video->pointOfInterest->id;
        $this->detailsModal['thematicAreaName'] = $video->thematicArea->name;
        $this->detailsModal['thematicAreaId'] = $video->thematicArea->id;
        $this->detailsModal['creatorName'] = User::find($video->creator)->name;
        $this->detailsModal['creatorId'] = $video->creator;
        $this->detailsModal['updaterName'] = User::find($video->updater)->name;
        $this->detailsModal['updaterId'] = $video->updater;
        $this->detailsModal['createdAt'] = $video->created_at;
        $this->detailsModal['updatedAt'] = $video->updated_at;
    }

    public function delete(Video $video)
    {
        $video->delete();
    }

    public function render()
    {
        if (auth()->user()->hasRole('Estudiante')) {
            $videos = Video::where('creator', auth()->user()->id)->paginate(10);
        } else {
            $videos = Video::paginate(10);
        }

        return view('livewire.admin.video.show-videos', compact('videos'));
    }
}
