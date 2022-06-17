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
    public function TestPointCanBeUpdated()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->actingAs($adminUser);

        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.name', 'Prueba')
            ->set('editForm.distance', '30')
            ->set('editForm.latitude', '84')
            ->set('editForm.longitude', '78')
            ->set('editForm.place', $place2->id)
            ->call('update', $pointOfInterest);

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('point_of_interests', [
            'id' => $pointOfInterest->id,
            'name' => 'Prueba',
            'distance' => '30',
            'latitude' => '84',
            'longitude' => '78',
            'place_id' => $place2->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }

    /** @test */
    public function TestNameIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->actingAs($adminUser);

        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.distance', '30')
            ->set('editForm.latitude', '84')
            ->set('editForm.longitude', '78')
            ->set('editForm.place', $place2->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.name' => 'required']);;

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('point_of_interests', [
            'id' => $pointOfInterest->id,
            'name' => $pointOfInterest->name,
            'distance' => $pointOfInterest->distance,
            'latitude' => $pointOfInterest->latitude,
            'longitude' => $pointOfInterest->longitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }

    /** @test */
    public function TestDistanceIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->actingAs($adminUser);

        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.name', 'Prueba')
            ->set('editForm.latitude', '84')
            ->set('editForm.longitude', '78')
            ->set('editForm.place', $place2->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.distance' => 'required']);;

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('point_of_interests', [
            'id' => $pointOfInterest->id,
            'name' => $pointOfInterest->name,
            'distance' => $pointOfInterest->distance,
            'latitude' => $pointOfInterest->latitude,
            'longitude' => $pointOfInterest->longitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }

    /** @test */
    public function TestLatitudeIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->actingAs($adminUser);

        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.name', 'Prueba')
            ->set('editForm.distance', '20')
            ->set('editForm.longitude', '78')
            ->set('editForm.place', $place2->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.latitude' => 'required']);;

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('point_of_interests', [
            'id' => $pointOfInterest->id,
            'name' => $pointOfInterest->name,
            'distance' => $pointOfInterest->distance,
            'latitude' => $pointOfInterest->latitude,
            'longitude' => $pointOfInterest->longitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }

    /** @test */
    public function TestLongitudeIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->actingAs($adminUser);

        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.name', 'Prueba')
            ->set('editForm.distance', '20')
            ->set('editForm.latitude', '84')
            ->set('editForm.place', $place2->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.longitude' => 'required']);;

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('point_of_interests', [
            'id' => $pointOfInterest->id,
            'name' => $pointOfInterest->name,
            'distance' => $pointOfInterest->distance,
            'latitude' => $pointOfInterest->latitude,
            'longitude' => $pointOfInterest->longitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }

    /** @test */
    public function TestPlaceIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->actingAs($adminUser);

        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.name', 'Prueba')
            ->set('editForm.distance', '20')
            ->set('editForm.latitude', '84')
            ->set('editForm.longitude', '78')
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.place' => 'required']);;

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('point_of_interests', [
            'id' => $pointOfInterest->id,
            'name' => $pointOfInterest->name,
            'distance' => $pointOfInterest->distance,
            'latitude' => $pointOfInterest->latitude,
            'longitude' => $pointOfInterest->longitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }

    /** @test */
    public function TestPlacesExist()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->actingAs($adminUser);

        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.name', 'Prueba')
            ->set('editForm.distance', '20')
            ->set('editForm.latitude', '84')
            ->set('editForm.longitude', '78')
            ->set('editForm.place', '99')
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.place' => 'exists']);;

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('point_of_interests', [
            'id' => $pointOfInterest->id,
            'name' => $pointOfInterest->name,
            'distance' => $pointOfInterest->distance,
            'latitude' => $pointOfInterest->latitude,
            'longitude' => $pointOfInterest->longitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }

    /** @test */
    public function TestDistanceIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->actingAs($adminUser);

        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.name', 'Prueba')
            ->set('editForm.distance', 'aaaaaa')
            ->set('editForm.latitude', '84')
            ->set('editForm.longitude', '78')
            ->set('editForm.place', $place2->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.distance' => 'numeric']);;

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('point_of_interests', [
            'id' => $pointOfInterest->id,
            'name' => $pointOfInterest->name,
            'distance' => $pointOfInterest->distance,
            'latitude' => $pointOfInterest->latitude,
            'longitude' => $pointOfInterest->longitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }

    /** @test */
    public function TestLatitudeIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->actingAs($adminUser);

        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.name', 'Prueba')
            ->set('editForm.distance', '20')
            ->set('editForm.latitude', 'aaaaaaaa')
            ->set('editForm.longitude', '78')
            ->set('editForm.place', $place2->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.latitude' => 'numeric']);;

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('point_of_interests', [
            'id' => $pointOfInterest->id,
            'name' => $pointOfInterest->name,
            'distance' => $pointOfInterest->distance,
            'latitude' => $pointOfInterest->latitude,
            'longitude' => $pointOfInterest->longitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }

    /** @test */
    public function TestLongitudeIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = factory(PointOfInterest::class)->create([
            'place_id' => $place->id,
        ]);

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->actingAs($adminUser);

        $place2 = $this->createPlace();

        Livewire::test(EditPoint::class)
            ->set('editForm.name', 'Prueba')
            ->set('editForm.distance', '20')
            ->set('editForm.latitude', '84')
            ->set('editForm.longitude', 'aaaaaaa')
            ->set('editForm.place', $place2->id)
            ->call('update', $pointOfInterest)
            ->assertHasErrors(['editForm.longitude' => 'numeric']);;

        $this->assertDatabaseCount('point_of_interests', 1);
        $this->assertDatabaseHas('point_of_interests', [
            'id' => $pointOfInterest->id,
            'name' => $pointOfInterest->name,
            'distance' => $pointOfInterest->distance,
            'latitude' => $pointOfInterest->latitude,
            'longitude' => $pointOfInterest->longitude,
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }
}
