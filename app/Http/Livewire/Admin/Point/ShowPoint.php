<?php

namespace App\Http\Livewire\Admin\Point;

use App\Models\PointOfInterest;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use function view;

class ShowPoint extends Component
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
        'name' => null,
        'distance' => null,
        'latitude' => null,
        'longitude' => null,
        'placeId' => null,
        'placeName' => null,
        'creatorName' => null,
        'creatorId' => null,
        'updaterName' => null,
        'updaterId' => null,
        'createdAt' => null,
        'updatedAt' => null,
    ];

    public function show(PointOfInterest $point)
    {
        $this->detailsModal['open'] = true;
        $this->detailsModal['id'] = $point->id;
        $this->detailsModal['name'] = $point->name;
        $this->detailsModal['distance'] = $point->distance;
        $this->detailsModal['latitude'] = $point->latitude;
        $this->detailsModal['longitude'] = $point->longitude;
        $this->detailsModal['placeId'] = $point->place;
        $this->detailsModal['placeName'] = $point->place->name;
        $this->detailsModal['creatorName'] = User::find($point->creator)->name;
        $this->detailsModal['creatorId'] = $point->creator;
        $this->detailsModal['updaterName'] = $point->updater ? User::find($point->updater)->name : null;;
        $this->detailsModal['updaterId'] = $point->updater;
        $this->detailsModal['createdAt'] = $point->created_at;
        $this->detailsModal['updatedAt'] = $point->updated_at;
    }

    public function delete(PointOfInterest $pointOfInterest)
    {
        $pointOfInterest->delete();

        Log::info('Point with ID ' . $pointOfInterest->id . ' was deleted ' . $pointOfInterest);
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
            $points = PointOfInterest::where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        } else {
            $points = PointOfInterest::where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        }

        return view('livewire.admin.point.show-point', compact('points'));
    }
}
