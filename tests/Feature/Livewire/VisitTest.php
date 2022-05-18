<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Admin\CreateVisits;
use App\Models\PointOfInterest;
use App\Models\User;
use App\Models\Visit;
use Livewire\Livewire;
use Tests\TestCase;


class VisitTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Visit::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function visit_is_created()
    {
        $visit = $this->createVisit();

        Livewire::test(CreateVisits::class, ['visit' => $visit])
        ->call('save', $visit)
        ->assertStatus(200);

    }

    public function createVisit()
    {
        $point = PointOfInterest::factory()->create();
        $user = User::factory()->create();
        $visit = Visit::factory()->create();

        dd($user);

        $point->creator()->attach($user->id);
        $point->updater()->attach($user->id);

        $visit->pointOfInterest()->attach($point->point_of_interest_id);

        return $visit;
    }
}
