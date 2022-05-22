<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use function view;

class ShowVisits extends Component
{
    use WithPagination;


    public $search;

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
        $visits = \App\Models\Visit::where('useragent', 'LIKE', "%{$this->search}%")->paginate(20);

        return view('livewire.admin.show-visits', compact('visits'));
    }
}
