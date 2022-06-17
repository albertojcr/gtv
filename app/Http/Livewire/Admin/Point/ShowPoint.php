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

    public $detailsModal = [
        'open' => false,
        'id' => null,
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

    public function render()
    {
        if (auth()->user()->hasRole('Alumno')) {
            $points = PointOfInterest::where('creator', auth()->user()->id)->orderByDesc('id')->paginate(10);
        } else {
            $points = PointOfInterest::orderByDesc('id')->paginate(10);
        }

        return view('livewire.admin.point.show-point', compact('points'));
    }
}
