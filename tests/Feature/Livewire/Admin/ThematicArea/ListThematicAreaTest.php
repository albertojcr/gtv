<?php

namespace Tests\Feature\Livewire\Admin\ThematicArea;

use Tests\TestCase;

class ListThematicAreaTest extends TestCase
{
    /** @test */
    public function itShowsTheThematicAreas()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);

        $thematicArea1 = $this->createThematicArea($pointOfInterest->id);
        $thematicArea2 = $this->createThematicArea($pointOfInterest->id);

        $this->actingAs($adminUser);

        $this->get('areas-tematicas')
            ->assertOk()
            ->assertSeeInOrder([
                $thematicArea1->description,
                $thematicArea2->description,
            ]);
    }
}
