<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Place;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListPlaces extends Component
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
        'description' => null,
        'creatorName' => null,
        'creatorId' => null,
        'updaterName' => null,
        'updaterId' => null,
        'deletedAt' => null,
        'createdAt' => null,
        'updatedAt' => null,
    ];

    public function show(Place $place)
    {
        $this->detailsModal['open'] = true;
        $this->detailsModal['id'] = $place->id;
        $this->detailsModal['name'] = $place->name;
        $this->detailsModal['description'] = $place->description;
        $this->detailsModal['creatorName'] = User::find($place->creator)->name;
        $this->detailsModal['creatorId'] = $place->creator;
        $this->detailsModal['updaterName'] = $place->updater ? User::find($place->updater)->name : null;
        $this->detailsModal['updaterId'] = $place->updater;
        $this->detailsModal['createdAt'] = $place->created_at;
        $this->detailsModal['updatedAt'] = $place->updated_at;
    }

    public function delete(Place $place)
    {
        $place->delete();
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
            $places = Place::where('creator', auth()->user()->id)
                ->where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        } else {
            $places = Place::where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        }

        return view('livewire.admin.places.list-places', compact('places'));
    }
}
