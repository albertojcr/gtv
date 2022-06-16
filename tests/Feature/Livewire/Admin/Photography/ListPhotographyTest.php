<?php

namespace Tests\Feature;

use Tests\TestCase;

class ListPhotographyTest extends TestCase
{
    /** @test */
    public function itShowsThePhotographies()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);
        $this->createThematicArea($pointOfInterest->id);

        $photographyA = $this->createPhotography();
        $photographyB = $this->createPhotography();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('photographies', 2);

        $this->get('fotografias')
            ->assertOk()
            ->assertSeeInOrder([
                $photographyA->id,
                $photographyB->id,
            ]);
    }
}
