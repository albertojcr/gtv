<?php

namespace Tests\Feature\Livewire\Admin\ThematicArea;

use App\Http\Livewire\Admin\ThematicArea\ThematicAreas;
use App\Models\ThematicArea;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteThematicAreaTest extends TestCase
{
    /** @test */
    public function itDeletesAThematicArea()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);

        $thematicArea = $this->createThematicArea($pointOfInterest->id);

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => $thematicArea->id,
            'name' => $thematicArea->name,
            'description' => $thematicArea->description,
        ]);

        Livewire::test(ThematicAreas::class)
            ->call('delete', $thematicArea);

        $this->assertDatabaseCount('videos', 0);
    }
}
