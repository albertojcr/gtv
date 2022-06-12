<?php

namespace Tests\Feature\Livewire\Admin\PointOfInterest;

use App\Http\Livewire\Admin\Video\CreateVideo;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class ShowPointTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ListPointsOfInterest()
    {
        $adminUser = $this->createAdmin();
        $place1 = $this->createPlace();
        $place2 = $this->createPlace();
        $pointOfInterest1 = $this->createPointOfInterest($place1->id);
        $pointOfInterest2 = $this->createPointOfInterest($place2->id);

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interests', 2);

        $this->get('points')
            ->assertOk()
            ->assertSeeInOrder([
                $pointOfInterest1->latitude,
                $pointOfInterest2->latitude,
            ]);
    }
}

