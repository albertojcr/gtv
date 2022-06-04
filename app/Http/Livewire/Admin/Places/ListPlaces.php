<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListPlaces extends Component
{
    use WithPagination;

    public $listeners = ['delete', 'render'];

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
        $this->detailsModal['updaterName'] = User::find($place->updater)->name;
        $this->detailsModal['updaterId'] = $place->updater;
        $this->detailsModal['createdAt'] = $place->created_at;
        $this->detailsModal['updatedAt'] = $place->updated_at;
    }

    public function delete(Place $place)
    {
        if(Storage::exists($place->route)) {
            Storage::delete($place->route);
        }

        $place->delete();
    }

    public function render()
    {
        if (auth()->user()->hasRole('Alumno')) {
            $places = Place::where('creator', auth()->user()->id)->orderByDesc('id')->paginate(10);
        } else {
            $places = Place::orderByDesc('id')->paginate(10);
        }

        return view('livewire.admin.places.list-places', compact('places'));
    }
}
