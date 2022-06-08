<?php

namespace App\Http\Livewire\Admin\Video;

use Livewire\Component;

class VideoPreview extends Component
{
    public $route = '';
    protected $listeners = ['render'];

    public function render()
    {
        return view('livewire.admin.video.video-preview');
    }
}
