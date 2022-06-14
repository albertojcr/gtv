<?php

namespace Tests\Feature\Livewire\Admin\Visit;

use App\Http\Livewire\Admin\Visit\CreateVisits;
use App\Models\PointOfInterest;
use App\Models\User;
use App\Models\Visit;
use Livewire\Livewire;
use Tests\TestCase;
use function dd;


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
            ->assertSeeInOrder([
                $visitA->ssoo,
                $visitB->ssoo,
            ]);
    }
}
