<?php

namespace App\Http\Livewire\Admin\Visit;

use App\Models\PointOfInterest;
use App\Models\Visit;
use Livewire\Component;
use Livewire\WithPagination;
use function view;

class ShowVisits extends Component
{
    use WithPagination;

    public $pointName;

    protected $listeners = ['delete', 'render'];

    public $detailsModal = [
        'open' => false,
        'id' => null,
        'hour' => null,
        'deviceid' => null,
        'appversion' => null,
        'useragent' => null,
        'ssoo' => null,
        'ssooversion' => null,
        'latitude' => null,
        'longitude' => null,
        'point_of_interest_id' => null,
    ];

    public function show(Visit $visit)
    {
        $this->pointName = $this->getPointName($visit->point_of_interest_id);

        $this->detailsModal['open'] = true;
        $this->detailsModal['id'] = $visit->id;
        $this->detailsModal['hour'] = $visit->hour;
        $this->detailsModal['deviceid'] = $visit->deviceid;
        $this->detailsModal['appversion'] = $visit->appversion;
        $this->detailsModal['useragent'] = $visit->useragent;
        $this->detailsModal['ssoo'] = $visit->ssoo;
        $this->detailsModal['ssooversion'] = $visit->ssooversion;
        $this->detailsModal['latitude'] = $visit->latitude;
        $this->detailsModal['longitude'] = $visit->longitude;
        $this->detailsModal['point_of_interest_id'] = $this->pointName;
        $this->detailsModal['createdAt'] = $visit->created_at;

    }

    public function getPointName($pointId)
    {
        return PointOfInterest::find($pointId);
    }

    public function delete(Visit $visit)
    {
        $visit->delete();
    }

    public function render()
    {
        return view('livewire.admin.visit.show-visits', ['visits' => Visit::paginate(20)]);
    }


}
