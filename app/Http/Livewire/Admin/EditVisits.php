<?php

namespace App\Http\Livewire\Admin;

use App\Models\PointOfInterest;
use App\Models\Visit;
use Livewire\Component;
use function redirect;
use function view;

class EditVisits extends Component
{
    public $punto_interes, $point_id,$latitud_punto, $longitud_punto;
    protected $listeners = ['refreshVisit'];

    public function refreshVisit()
    {
        $this->visit = $this->visit->fresh();
    }

    public function mount(Visit $visit)
    {
        $this->visit = $visit;
        $this->punto_interes = PointOfInterest::where('id',  $visit->point_of_interest_id)->first();
        $this->latitud_punto = $this->punto_interes->latitude;
        $this->longitud_punto = $this->punto_interes->longitude;
    }

    public function render()
    {
        return view('livewire.admin.edit-visits')->layout('layouts.app');
    }
}
