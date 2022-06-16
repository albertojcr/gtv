<?php

namespace App\Http\Livewire;

use App\Models\Place;
use App\Models\User;
use Livewire\Component;

class Welcome extends Component
{
    public $listeners = ['delete', 'render'];
    public $countplaces;

    public $detailsModalPlaces = [
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

    public function showPlaces(Place $place)
    {
        $this->detailsModalPlaces['open'] = true;
        $this->detailsModalPlaces['id'] = $place->id;
        $this->detailsModalPlaces['name'] = $place->name;
        $this->detailsModalPlaces['description'] = $place->description;
        $this->detailsModalPlaces['creatorName'] = User::find($place->creator)->name;
        $this->detailsModalPlaces['creatorId'] = $place->creator;
        $this->detailsModalPlaces['updaterName'] = $place->updater ? User::find($place->updater)->name : null;
        $this->detailsModalPlaces['updaterId'] = $place->updater;
        $this->detailsModalPlaces['createdAt'] = $place->created_at;
        $this->detailsModalPlaces['updatedAt'] = $place->updated_at;
    }

    public function mount() {

        if(auth()->user()->hasRole('Alumno')) {
            $this->countplaces = Place::where('creator', auth()->user()->id)->count();
        } else {
            $this->countplaces = Place::all()->count();
        }
    }

    public function render()
    {
        if(auth()->user()->hasRole('Alumno')) {
            $places = Place::where('creator', auth()->user()->id)->orderByDesc('id')->paginate(3);
        } else {
            $places = Place::orderByDesc('id')->paginate(3);
        }

        return view('livewire.welcome', compact('places', 'videos', 'points', 'photographies'));
    }
}
