<?php

namespace Tests\Feature\Livewire\Admin\PointOfInterest;

use App\Http\Livewire\Admin\Point\EditPoint;
use App\Models\PointOfInterest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EditPointTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function PointCanBeUpdated()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'latitude' => '12',
            'longitude' => '16',
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->assertDatabaseHas('point_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);

        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.place', $place2->id)
            ->set('editForm.longitude', '99')
            ->call('update', $pointOfInterest);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->assertDatabaseHas('point_of_interests', [
            'longitude' => '99',
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place2->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }

    /** @test */
    public function DistanceIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'latitude' => '12',
            'longitude' => '16',
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->assertDatabaseHas('point_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);

        Livewire::test(EditPoint::class)
            ->set('editForm.latitude', '10')
            ->set('editForm.longitude', '15')
            ->set('editForm.place', $place->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.distance' => 'required']);

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('points_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }

    /** @test */
    public function LatitudeIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'latitude' => '12',
            'longitude' => '16',
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->assertDatabaseHas('point_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);

        Livewire::test(EditPoint::class)
            ->set('editForm.distance', '10')
            ->set('editForm.longitude', '15')
            ->set('editForm.place', $place->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.latitude' => 'required']);

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('points_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }

    /** @test */
    public function LongitudeIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'latitude' => '12',
            'longitude' => '16',
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->assertDatabaseHas('point_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);

        Livewire::test(EditPoint::class)
            ->set('editForm.distance', '10')
            ->set('editForm.latitude', '15')
            ->set('editForm.place', $place->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.longitude' => 'required']);

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('points_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }

    /** @test */
    public function PlaceIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'latitude' => '12',
            'longitude' => '16',
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->assertDatabaseHas('point_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);
        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.distance', '10')
            ->set('editForm.latitude', '15')
            ->set('editForm.place', $place2->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.place' => 'required']);

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('points_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }

    /** @test */
    public function PlacesExist()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'latitude' => '12',
            'longitude' => '16',
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->assertDatabaseHas('point_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);
        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.distance', '10')
            ->set('editForm.latitude', '15')
            ->set('editForm.place', '99999999')
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.place' => 'exist']);

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('points_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }

    /** @test */
    public function DistanceIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'latitude' => '12',
            'longitude' => '16',
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->assertDatabaseHas('point_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);

        Livewire::test(EditPoint::class)
            ->set('editForm.distance', 'aaaaaa')
            ->set('editForm.latitude', '10')
            ->set('editForm.longitude', '15')
            ->set('editForm.place', $place->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.distance' => 'number']);

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('points_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }

    /** @test */
    public function LatitudeIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'latitude' => '12',
            'longitude' => '16',
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->assertDatabaseHas('point_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);

        Livewire::test(EditPoint::class)
            ->set('editForm.latitude', 'aaaaaaa')
            ->set('editForm.longitude', '15')
            ->set('editForm.place', $place->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.latitude' => 'number']);

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('points_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }

    /** @test */
    public function LongitudeIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'latitude' => '12',
            'longitude' => '16',
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->assertDatabaseHas('point_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);

        Livewire::test(EditPoint::class)
            ->set('editForm.latitude', '10')
            ->set('editForm.longitude', 'aaaaaaaaaa')
            ->set('editForm.place', $place->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.longitude' => 'number']);

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('points_of_interests', [
            'longitude' => $pointOfInterest->longitude,
            'latitude' => $pointOfInterest->latitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }
}
