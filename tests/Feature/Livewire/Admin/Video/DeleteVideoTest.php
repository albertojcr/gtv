<?php

namespace Tests\Feature\Livewire\Admin\Video;

use App\Http\Livewire\Admin\Video\ListVideos;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteVideoTest extends TestCase
{
    public function testICanDeleteAnExistingVideo()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);
        $this->createThematicArea($pointOfInterest->id);
        $video = $this->createVideo();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseCount('video_items', 1);

        $this->assertDatabaseHas('videos', [
            'point_of_interest_id' => $video->pointOfInterest->id,
            'order' => $video->order,
            'creator' => $video->creator,
            'updater' => $video->updater,
            'thematic_area_id' => $video->thematicArea->id,
            'description' => $video->description,
        ]);

        $this->assertDatabaseHas('video_items', [
            'video_id' => $video->id,
        ]);

        Livewire::test(ListVideos::class)
            ->call('delete', $video);

        $this->assertDatabaseCount('videos', 0);
        $this->assertDatabaseCount('video_items', 0);
    }
}
