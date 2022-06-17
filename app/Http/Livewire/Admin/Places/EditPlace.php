<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Place;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EditPlace extends Component
{
    public $placeId;

    protected $listeners = ['openEditModal'];

    public $editForm = [
        'open' => false,
        'name' => '',
        'description' => '',
    ];

    protected $rules = [
        'editForm.name' => 'required',
        'editForm.description' => 'required|string|max:2000',
    ];

    protected $validationAttributes = [
        'editForm.name' => 'nombre',
        'editForm.description' => 'descripción',
    ];

    public function openEditModal(Place $place)
    {
        $this->reset(['editForm']);

        $this->placeId = $place->id;
        $this->editForm['name'] = $place->name;
        $this->editForm['description'] = $place->description;

        $this->editForm['open'] = true;
    }

    public function update(Place $place)
    {
        $this->validate();

        $place->update([
            'name' => $this->editForm['name'],
            'description' => $this->editForm['description'],
            'updater' => auth()->user()->id,
        ]);

        Log::info('Place with ID ' . $place->id . ' was updated ' . $place);

        $this->editForm['open'] = false;
        $this->reset(['editForm']);

        $this->emitTo('admin.places.list-places', 'render');
        $this->emit('placeUpdated');
    }

    public function render()
    {
        return view('livewire.admin.places.edit-place');
    }
}
