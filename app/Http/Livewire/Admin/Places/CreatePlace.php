<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Place;
use Livewire\Component;

class CreatePlace extends Component
{
    protected $listeners = ['openCreationModal'];

    public $createForm = [
        'open' => false,
        'name' => '',
        'description' => '',
    ];

    protected $rules = [
        'createForm.name' => 'required',
        'createForm.description' => 'required|string|max:2000',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.description' => 'descripción',
    ];

    public function openCreationModal()
    {
        $this->createForm['open'] = true;
    }

    public function save()
    {
        $this->validate();

        Place::create([
            'name' => $this->createForm['name'],
            'description' => $this->createForm['description'],
            'creator' => auth()->user()->id,
            'updater' => auth()->user()->id,
        ]);

        $this->reset('createForm');
        $this->emit('placeCreated');
        $this->emitTo('admin.places.list-places', 'render');
    }


    public function render()
    {
        return view('livewire.admin.places.create-place');
    }
}
