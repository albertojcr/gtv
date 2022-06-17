<?php

namespace App\Http\Livewire\Admin\Video;

use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListVideos extends Component
{
    use WithPagination;

    public $listeners = ['delete', 'render'];

    public $search;
    public $searchColumn = 'id';

    public $sortField = 'id';
    public $sortDirection = 'desc';

    protected $queryString = ['search'];

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
        $this->detailsModal['pointOfInterest'] = $video->pointOfInterest->id ?? '';
        $this->detailsModal['thematicAreaName'] = $video->thematicArea->name ?? '';
        $this->detailsModal['thematicAreaId'] = $video->thematicArea->id ?? '';
        $this->detailsModal['creatorName'] = User::find($video->creator)->name;
        $this->detailsModal['creatorId'] = $video->creator;
        $this->detailsModal['updaterName'] = $video->updater ? User::find($video->updater)->name : null;;
        $this->detailsModal['updaterId'] = $video->updater;
        $this->detailsModal['createdAt'] = $video->created_at;
        $this->detailsModal['updatedAt'] = $video->updated_at;
    }

    public function delete(Video $video)
    {
        if(Storage::exists($video->route)) {
            Storage::delete($video->route);
        }

        $video->delete();
    }

    public function sort($field)
    {
        if ($this->sortField === $field && $this->sortDirection !== 'desc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function resetFilters()
    {
        $this->reset(['search', 'sortField', 'sortDirection']);
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if (auth()->user()->hasRole('Alumno')) {
            $videos = Video::where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        } else {
            $videos = Video::where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        }

        return view('livewire.admin.video.list-videos', compact('videos'));
    }
}
