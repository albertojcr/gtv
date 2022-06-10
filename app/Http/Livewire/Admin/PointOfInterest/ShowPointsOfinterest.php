<?php

namespace App\Http\Livewire\Admin\PointOfInterest;

use App\Models\PointOfInterest;
use Livewire\Component;
use Livewire\WithPagination;
use function view;

class ShowPointsOfinterest extends Component
{
    use WithPagination;

    protected $listeners = ['delete'];

    public function delete(PointOfInterest $pointOfInterest)
    {
        $pointOfInterest->delete();
    }

    public function render()
    {
        return view('livewire.show-points-ofinterest', ['points' => PointOfInterest::paginate(20)]);
    }
}
