<?php

namespace Tests\Feature\Livewire\Admin\Visit;

use Tests\TestCase;


class ShowVisitsTest extends TestCase
{
    /** @test */
    public function TestShowVisits()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $visitA = $this->createVisit($pointOfInterestA->id);
        $visitB = $this->createVisit($pointOfInterestB->id);

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('visits', 2);

        $this->get('visits')
            ->assertOk()
            ->assertSee([
                $visitA->deviceid,
                $visitB->deviceid,
            ]);
    }
}
