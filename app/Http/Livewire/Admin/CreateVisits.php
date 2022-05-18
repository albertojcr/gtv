<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Admin\Visit;
use App\Models\PointOfInterest;
use Livewire\Component;
use function redirect;
use function view;

class CreateVisits extends Component
{
    public $point_of_interest, $deviceid;

    protected $rules = [
        'deviceid' => 'required'
    ];

    public function mount()
    {
        $this->point_of_interest = PointOfInterest::all();
    }

    public function save()
    {
        $this->validate();
        $visit = new Visit();
        $visit->point_of_interest = $this->point_of_interest;
        $visit->deviceid = $this->deviceid;
        $visit->save();

        return redirect()->route('', $visit);
    }

    public function delete()
    {
        $this->visit->delete();

        return redirect()->route('admin.index');
    }

    public function render()
    {
        return view('livewire.admin.create-visit')->layout('layouts.admin'); //FALTA LAS VISTAS!!!!!
    }
}
