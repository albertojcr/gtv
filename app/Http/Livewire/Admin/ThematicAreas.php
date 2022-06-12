<?php

namespace App\Http\Livewire\Admin;

use App\Models\ThematicArea;
use Livewire\Component;
use Livewire\WithPagination;

class ThematicAreas extends Component
{
    use WithPagination;

    public $listeners = ['delete'];

    public $showForm = false;

    public $createForm = [
        'name' => null,
        'description' => null,
    ];
    public $editForm = [
        'name' => null,
        'description' => null,
    ];

    protected $rules = [
        'createForm.name' => '',
        'createForm.description' => '',
    ];

    protected $validationAttributes = [
        'createForm.name'        => 'nombre',
        'createForm.description' => 'descripción',

        'editForm.name'        => 'nombre',
        'editForm.description' => 'descripción',
    ];

    public $editModal = [
        'open' => false,
        'id' => null,
        'createdAt' => null,
        'updatedAt' => null,
    ];

    public function edit(ThematicArea $thematicArea)
    {
        $this->editModal['id'] = $thematicArea->id;

        $this->editForm['name'] = $thematicArea->name;
        $this->editForm['description'] = $thematicArea->description;

        $this->editModal['createdAt'] = $thematicArea->created_at;
        $this->editModal['updatedAt'] = $thematicArea->updated_at;

        $this->editModal['open'] = true;
    }

    public function save()
    {
        $this->validate();

        ThematicArea::create([
            'name'        => $this->createForm['name'],
            'description' => $this->createForm['description'],
            'updated_at' => null,
        ]);

        $this->reset('createForm');
    }

    public function update(ThematicArea $thematicArea)
    {
        $this->validate([
            'editForm.name' => '',
            'editForm.description' => '',
        ]);

        $thematicArea['name'] = $this->editForm['name'];
        $thematicArea['description'] = $this->editForm['description'];

        $thematicArea->update();

        $this->editModal['open'] = false;
    }

    public function delete(ThematicArea $thematicArea)
    {
        $thematicArea->pointsOfInterest()->detach();

        $thematicArea->delete();
    }

    public function render()
    {
        if(auth()->user()->hasRole('Super Administrador')
            || auth()->user()->hasRole('Administrador')) {

            $thematicAreas = ThematicArea::paginate(10);
        }

        return view('livewire.admin.thematic-areas', compact('thematicAreas'));
    }
}
