<?php

namespace App\Http\Livewire\Admin\Photography;

use App\Jobs\ProcessPhotography;
use App\Models\Photography;
use App\Models\PointOfInterest;
use App\Models\ThematicArea;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Photographies extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $pointsOfInterest;
    public $thematicAreas;

    public $listeners = ['delete'];

    public $search;
    public $searchColumn = 'id';

    public $sortField = 'id';
    public $sortDirection = 'desc';

    protected $queryString = ['search'];

    public $createForm = [
        'open' => false,
        'route' => null,
        'order' => '',
        'pointOfInterestId' => '',
        'thematicAreaId' => '',
    ];

    public $editForm = [
        'route' => null,
        'order' => '',
        'pointOfInterestId' => '',
        'thematicAreaId' => '',
    ];

    protected $rules = [
        'createForm.route' => 'image|max:5120',
        'createForm.pointOfInterestId' => 'required|integer',
        'createForm.thematicAreaId' => 'required|integer',
    ];

    protected $validationAttributes = [
        'createForm.route' => 'fotografía',
        'createForm.pointOfInterestId' => 'punto de interes',
        'createForm.thematicAreaId' => 'área temática',

        'editForm.route' => 'fotografía',
        'editForm.pointOfInterestId' => 'punto de interes',
        'editForm.thematicAreaId' => 'área temática',
    ];

    public $showModal = [
        'open' => false,
        'id' => null,
        'route' => null,
        'order' => null,
        'pointOfInterestId' => null,
        'thematicAreaId' => null,
        'thematicAreaName' => null,
        'creatorId' => null,
        'creatorName' => null,
        'updaterId' => null,
        'updaterName' => null,
        'createdAt' => null,
        'updatedAt' => null,
    ];

    public $editModal = [
        'open' => false,
        'id' => null,
        'route' => null,
        'order' => null,
        'pointOfInterestId' => null,
        'thematicAreaId' => null,
        'thematicAreaName' => null,
        'creatorId' => null,
        'creatorName' => null,
        'updaterId' => null,
        'updaterName' => null,
        'createdAt' => null,
        'updatedAt' => null,
    ];

    public function mount()
    {
        $this->getPointsOfInterest();
        $this->getThematicAreas();
    }

    public function getPointsOfInterest()
    {
        $this->pointsOfInterest = PointOfInterest::all();
    }

    public function getThematicAreas()
    {
        $this->thematicAreas = ThematicArea::all();
    }

    public function updatedCreateFormPointOfInterestId()
    {
        $this->createForm['thematicAreaId'] = '';
        $this->thematicAreas = PointOfInterest::find($this->createForm['pointOfInterestId'])->thematicAreas;

        //$this->createForm['thematicAreaId'] = $this->thematicAreas[0]->id;
    }

    public function updatedEditFormPointOfInterestId()
    {
        $this->editForm['thematicAreaId'] = '';
        $this->thematicAreas = PointOfInterest::find($this->editForm['pointOfInterestId'])->thematicAreas;

        //$this->editForm['thematicAreaId'] = $this->thematicAreas[0]->id;
    }

    public function save()
    {
        $this->validate();

        $this->createForm['route']->storeAs('public/photos', $this->createForm['route']->getFilename());

        $order = Photography::where('point_of_interest_id', $this->createForm['pointOfInterestId'])->count();

        $photography = Photography::create([
            'route' => 'storage/photos/' . $this->createForm['route']->getFilename(),
            'order' =>  $order + 1,
            'point_of_interest_id' => $this->createForm['pointOfInterestId'],
            'thematic_area_id' => $this->createForm['thematicAreaId'],
            'creator' => auth()->user()->id,
            'updater' => null,
            'updated_at' => null,
        ]);

        ProcessPhotography::dispatch($photography);

        $this->reset('createForm');

        $this->emit('photographyCreated');
    }

    public function update(Photography $photography)
    {
        $this->validate([
            'editForm.route' => 'max:5120',
            'editForm.pointOfInterestId' => 'required|integer',
            'editForm.thematicAreaId' => 'required|integer',
        ]);

        if (! is_null($this->editForm['route'])) {
            $this->editForm['route']->storeAs('public/photos', $this->editForm['route']->getFilename());

            $photography['route'] = 'storage/photos/' . $this->editForm['route']->getFilename();
        }

        $order = Photography::where('point_of_interest_id', $this->editForm['pointOfInterestId'])->count();

        $photography['order'] = $order +1;
        $photography['point_of_interest_id'] = $this->editForm['pointOfInterestId'];
        $photography['thematic_area_id'] = $this->editForm['thematicAreaId'];
        $photography['updater'] = auth()->user()->id;

        $photography->update();

        Log::info('Photography with ID ' . $photography->id . ' was updated ' . $photography);

        $this->reset(['editForm']);
        $this->reset(['editModal']);

        $this->emit('photographyUpdated');
    }

    public function show(Photography $photography)
    {
        if ( ! is_null( User::find($photography->updater) )) {
            $this->showModal['updaterId'] = User::find($photography->updater)->id;
            $this->showModal['updaterName'] = User::find($photography->updater)->name;
        } else {
            $this->showModal['updaterId'] = null;
            $this->showModal['updaterName'] = null;
        }

        $this->showModal['id'] = $photography->id;

        $this->showModal['route'] = $photography->route;
        $this->showModal['order'] = $photography->order;
        $this->showModal['pointOfInterestId'] = $photography['point_of_interest_id'];
        $this->showModal['thematicAreaId'] = $photography->thematicArea->id ?? '';
        $this->showModal['thematicAreaName'] = $photography->thematicArea->name ?? '';

        $this->showModal['creatorId'] = User::find($photography->creator)->id;
        $this->showModal['creatorName'] = User::find($photography->creator)->name;

        $this->showModal['createdAt'] = $photography->created_at;
        $this->showModal['updatedAt'] = $photography->updated_at;

        $this->showModal['open'] = true;
    }

    public function edit(Photography $photography)
    {
        $this->reset(['editForm']);

        $this->thematicAreas = PointOfInterest::find($photography['point_of_interest_id'])->thematicAreas;

        $this->editForm['pointOfInterestId'] = $photography['point_of_interest_id'];
        $this->editForm['thematicAreaId'] = $photography->thematicArea->id ?? '';

        $this->editModal['id'] = $photography->id;
        $this->editModal['route'] = $photography->route;

        $this->editModal['open'] = true;
    }

    public function delete(Photography $photography)
    {
        $photography->delete();

        Log::info('Photography with ID ' . $photography->id . ' was deleted ' . $photography);
    }

    public function sort($field)
    {
        if ($this->sortField === $field && $this->sortDirection !== 'desc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function resetFilters()
    {
        $this->reset(['search', 'sortField', 'sortDirection']);
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->reset(['page']);

        if (auth()->user()->hasRole('Alumno')) {
            $photographies = Photography::where('creator', auth()->user()->id)
                ->where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        } else {
            $photographies = Photography::where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        }

        return view('livewire.admin.photography.photographies', compact('photographies'));
    }
}
