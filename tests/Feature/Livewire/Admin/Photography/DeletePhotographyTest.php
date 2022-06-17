<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\Photography\Photographies;
use Livewire\Livewire;
use Tests\TestCase;

class DeletePhotographyTest extends TestCase
{
    /** @test */
    public function itDeletesAPhotography()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);
        $this->createThematicArea($pointOfInterest->id);
        $photography = $this->createPhotography();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('photographies', 1);

        $this->assertDatabaseHas('photographies', [
            'route' => $photography->route,
            'order' => $photography->order,
            'point_of_interest_id' => $photography['point_of_interest_id'],
            'thematic_area_id' => $photography->thematicArea->id,
            'creator' => $photography->creator,
            'updater' => $photography->updater,

        ]);

        Livewire::test(Photographies::class)
            ->call('delete', $photography);

        $this->assertDatabaseCount('photographies', 0);
    }
}
