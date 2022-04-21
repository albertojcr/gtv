<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVideoItemsRequest;
use App\Video;
use App\VideoItem;

class VideoItemsController extends Controller
{
    public function edit(VideoItem $videoitem)
    {
        $videos = Video::all();

        return view('admin.video_items.edit', compact('videoitem', 'videos'));
    }

    public function update(UpdateVideoItemsRequest $request, VideoItem $videoitem)
    {
        $videoitem->update($request->all());

        return redirect()->route('admin.videoitems.edit', $videoitem)->with('flash', 'Las caracteristicas de video han sido actualizadas correctamente');
    }
}
