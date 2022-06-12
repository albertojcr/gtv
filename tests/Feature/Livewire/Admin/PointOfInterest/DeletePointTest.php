<?php

namespace Tests\Feature\Livewire\Admin\PointOfInterest;

use App\Http\Livewire\Admin\PointOfInterest\ShowPointsOfinterest;
use App\Http\Livewire\Admin\Video\CreateVideo;
use App\Models\Video;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class DeletePointTest extends TestCase
{
    public function PointIsDeleted()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interest', 0);

        $this->assertDatabaseHas('point_of_interest', [
            'distance' => $pointOfInterest->distance,
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $pointOfInterest->place_id,
        ]);


        Livewire::test(ShowPointsOfinterest::class)
            ->call('delete', $pointOfInterest);

        $this->assertDatabaseCount('point_of_interest', 0);
    }
}
