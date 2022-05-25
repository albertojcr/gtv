<?php

namespace App\Http\Livewire\Admin;

use App\Models\Visit;
use Livewire\Component;
use Livewire\WithPagination;
use function view;

class ShowVisits extends Component
{
    use WithPagination;

    protected $listeners = ['delete'];

    public $search;

    public function delete(Visit $visit)
    {
        $visit->delete();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPagination()
    {
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.admin.show-visits', ['visits' => Visit::paginate(20),]);
    }
}
