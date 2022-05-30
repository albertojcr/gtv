<?php

namespace Tests\Feature\Livewire\Admin\Video;

use Tests\TestCase;

class ListVideoTest extends TestCase
{
    public function testICanListExistingVideoItems()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);
        $this->createThematicArea($pointOfInterest->id);
        $videoA = $this->createVideo();
        $videoB = $this->createVideo();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('videos', 2);
        $this->assertDatabaseCount('video_items', 2);

        $this->get('videos')
            ->assertOk()
            ->assertSeeInOrder([
                $videoB->description,
                $videoA->description,
            ]);
    }
}
