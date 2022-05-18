<?php

namespace App\Http\Livewire\Admin;

use App\Models\PointOfInterest;
use App\Models\Visit;
use Livewire\Component;
use function redirect;
use function view;

class EditVisits extends Component
{

    public $variables_de_la_visita;

    protected $rules = [
        'deviceid' => 'required',
        'appversion' => 'required',
        'useragent' => 'required',
        'ssoo' => 'required',
        'ssooversion' => 'required',
        'point_of_interest_id' => 'required',
    ];

    protected $listeners = ['refreshVisit','delete'];

    public function refreshVisit()
    {
        $this->visit = $this->visit->fresh();
    }

    public function delete()
    {
        $this->visit->delete();

        return redirect()->route('admin.index');//FALTA LA REDIRECCION
    }

    public function mount(Visit $visit)
    {
        $this->visit = $visit;
        $this->point_of_interest = PointOfInterest::all();
    }

    public function getPoinofinterestLongitude()
    {
        return PointOfInterest::find($this->visit->point_of_interest->longitude);
    }

    public function getPoinofinterestLatitude()
    {
        return PointOfInterest::find($this->visit->point_of_interest->latitude);
    }

    public function save()
    {
        $this->validate();
        $this->visit->save();
        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.edit-visits')->layout('');
    }
}
