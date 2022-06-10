<?php

namespace App\Http\Livewire\Admin\PointOfInterest;

use App\Models\PointOfInterest;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use function view;

class ShowPointsOfinterest extends Component
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
    }

    public function render()
    {
        return view('livewire.admin.pointsofinterest.show-points-ofinterest', ['points' => PointOfInterest::paginate(10)]);
    }
}
