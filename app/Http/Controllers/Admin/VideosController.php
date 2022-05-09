<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVideosRequest;
use App\Models\PointOfInterest;
use App\Models\ThematicArea;
use App\Models\Video;
use App\Models\VideoItem;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::allowed()->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Video());

        $request->validate([
            'description' => 'required'], [
            'description.required' => 'La descripción del video es requerida'
        ]);

        $video = Video::create($request->all());

        VideoItem::create([
            'video_id' => $video->id
        ]);

        return redirect()->route('admin.videos.edit', compact('video'))->with('flash', 'El video ha sido registrado correctamente');
    }

    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $this->authorize('update', $video);

        $pointsofinterest = PointOfInterest::all();
        $thematics_areas = ThematicArea::all();
        return view('admin.videos.edit', compact('video', 'pointsofinterest', 'thematics_areas'));
    }

    public function update(UpdateVideosRequest $request, Video $video)
    {
        $this->authorize('update', $video);

        $video->update($request->all());

        return redirect()->route('admin.videos.edit', compact('video'))->with('flash', 'El video ' . $video->description . ' ha sido editado correctamente');
    }

    public function destroy(Video $video)
    {
        $this->authorize('delete', $video);

        $video->delete();

        return redirect()->route('admin.videos.index')->with('flash', 'El video ' . $video->description . ' ha sido borrado correctamente');
    }
}
