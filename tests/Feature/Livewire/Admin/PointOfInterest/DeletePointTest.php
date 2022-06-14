<?php

namespace Tests\Feature\Livewire\Admin\PointOfInterest;

use App\Http\Livewire\Admin\Point\ShowPoint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeletePointTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function PointIsDeleted()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interests', 0);

        $this->assertDatabaseHas('point_of_interests', [
            'distance' => $pointOfInterest->distance,
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $pointOfInterest->place_id,
        ]);


        Livewire::test(ShowPoint::class)
            ->call('delete', $pointOfInterest);

        $this->assertDatabaseCount('point_of_interests', 0);
    }
}
