<?php

namespace Tests\Feature\Livewire\Admin\Visit;

use App\Http\Livewire\Admin\Visit\CreateVisits;
use App\Http\Livewire\Admin\Visit\EditVisits;
use App\Models\PointOfInterest;
use App\Models\User;
use App\Models\Visit;
use Livewire\Livewire;
use Tests\TestCase;
use function dd;


class EditVisitTest extends TestCase
{
    /** @test */
    public function TestAnExistingVisitCanBeUpdated()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);
        $visit = $this->createVisit($pointOfInterest->id);

        $this->assertDatabaseCount('visits', 1);

        $this->actingAs($adminUser);

        $placeEdit = $this->createPlace();
        $pointOfInterestEdit = $this->createPointOfInterest($placeEdit->id);

        Livewire::test(EditVisits::class)
            ->set('editForm.pointOfInterest', $pointOfInterestEdit->id)
            ->set('editForm.ssoo', 'PruebaEdicion')
            ->set('editForm.useragent', 'PruebaEdicion')
            ->call('update', $visit);

        $this->assertDatabaseCount('visits', 1);
        $this->assertDatabaseHas('visits',[
            'id' => $visit->id,
            'point_of_interest_id' => $pointOfInterestEdit->id,
            'ssoo' => 'PruebaEdicion',
            'useragent' => 'PruebaEdicion'
        ]);
    }

    /** @test */
    public function testPointOfInterestIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);
        $visit = $this->createVisit($pointOfInterest->id);

        $this->assertDatabaseCount('visits', 1);

        $this->actingAs($adminUser);

        $placeB = $this->createPlace();
        $pointOfInterestEdit = $this->createPointOfInterest($placeB->id);

        Livewire::test(EditVisits::class)
            ->set('editForm.ssoo', 'PruebaEdicion')
            ->set('editForm.useragent', 'PruebaEdicion')
            ->call('update', $visit)
            ->assertHasErrors(['editForm.pointOfInterest' => 'required']);

        $this->assertDatabaseCount('visits', 1);
        $this->assertDatabaseHas('visits',[
            'id' => $visit->id,
            'point_of_interest_id' => $pointOfInterest->id,
            'ssoo' => 'PruebaEdicion',
            'useragent' => 'PruebaEdicion'
        ]);
    }

    /** @test */
    public function testSSOOIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);
        $visit = $this->createVisit($pointOfInterest->id);

        $this->assertDatabaseCount('visits', 1);

        $this->actingAs($adminUser);

        $placeB = $this->createPlace();
        $pointOfInterestEdit = $this->createPointOfInterest($placeB->id);

        Livewire::test(EditVisits::class)
            ->set('editForm.pointOfInterest', $pointOfInterestEdit->id)
            ->set('editForm.useragent', 'PruebaEdicion')
            ->call('update', $visit)
            ->assertHasErrors(['editForm.ssoo' => 'required']);

        $this->assertDatabaseCount('visits', 1);
        $this->assertDatabaseHas('visits',[
            'id' => $visit->id,
            'point_of_interest_id' => $pointOfInterestEdit->id,
            'ssoo' => $visit->ssoo,
            'useragent' => 'PruebaEdicion'
        ]);
    }

    /** @test */
    public function testUserAgentIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);
        $visit = $this->createVisit($pointOfInterest->id);

        $this->assertDatabaseCount('visits', 1);

        $this->actingAs($adminUser);

        $placeB = $this->createPlace();
        $pointOfInterestEdit = $this->createPointOfInterest($placeB->id);

        Livewire::test(EditVisits::class)
            ->set('editForm.ssoo', 'PruebaEdicion')
            ->set('editForm.pointOfInterest', $pointOfInterestEdit->id)
            ->call('update', $visit)
            ->assertHasErrors(['editForm.useragent' => 'required']);

        $this->assertDatabaseCount('visits', 1);
        $this->assertDatabaseHas('visits',[
            'id' => $visit->id,
            'point_of_interest_id' => $pointOfInterestEdit->id,
            'ssoo' => 'PruebaEdicion',
            'useragent' => $visit->useragent
        ]);
    }

    /** @test */
    public function testUserAgentHasMaxLenght()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);
        $visit = $this->createVisit($pointOfInterest->id);

        $this->assertDatabaseCount('visits', 1);

        $this->actingAs($adminUser);

        $placeB = $this->createPlace();
        $pointOfInterestEdit = $this->createPointOfInterest($placeB->id);

        Livewire::test(EditVisits::class)
            ->set('editForm.ssoo', 'PruebaEdicion')
            ->set('editForm.pointOfInterest', $pointOfInterestEdit->id)
            ->set('editForm.useragent', \str_repeat('a',201))
            ->call('update', $visit)
            ->assertHasErrors(['editForm.useragent' => 'max']);

        $this->assertDatabaseCount('visits', 1);
        $this->assertDatabaseHas('visits',[
            'id' => $visit->id,
            'point_of_interest_id' => $pointOfInterestEdit->id,
            'ssoo' => 'PruebaEdicion',
            'useragent' => $visit->useragent
        ]);
    }
}
