<?php

namespace App\Http\Livewire\Admin\VideoItem;

use App\Models\VideoItem;
use Livewire\Component;

class ListVideoItems extends Component
{
    public function render()
    {
        $videoItems = VideoItem::orderByDesc('id')->paginate(10);

        return view('livewire.admin.video-item.list-video-items', compact('videoItems'));
    }
}
