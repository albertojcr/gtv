<?php

namespace Tests\Feature\Livewire\Admin\VideoItem;

use App\Models\VideoItem;
use Tests\TestCase;

class ListVideoItemTest extends TestCase
{
    public function testICanListExistingVideoItems()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);
        $this->createThematicArea($pointOfInterest->id);
        $videoA = $this->createVideo();
        $videoItemA = VideoItem::where('video_id', $videoA->id)->get();
        $videoB = $this->createVideo();
        $videoItemB = VideoItem::where('video_id', $videoB->id)->get();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('videos', 2);
        $this->assertDatabaseCount('video_items', 2);

        $this->assertDatabaseHas('video_items', [
            'video_id' => $videoA->id,
        ]);

        $this->assertDatabaseHas('video_items', [
            'video_id' => $videoB->id,
        ]);

        $this->get('video-items')
            ->assertOk()
            ->assertSeeInOrder([
                $videoItemB[0]->id,
                $videoItemB[0]->video->id,
                $videoItemB[0]->video->name,
                $videoItemB[0]->quality,
                $videoItemB[0]->format,
                $videoItemB[0]->orientation,
                $videoItemB[0]->created_at,
                $videoItemA[0]->id,
                $videoItemA[0]->video->id,
                $videoItemA[0]->video->name,
                $videoItemA[0]->quality,
                $videoItemA[0]->format,
                $videoItemA[0]->orientation,
                $videoItemA[0]->created_at,
            ]);
    }
}
