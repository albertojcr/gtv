<?php

namespace Tests\Feature\Livewire\Admin\PointOfInterest;

use App\Http\Livewire\Admin\Point\CreatePoint;
use App\Http\Livewire\Admin\Video\CreateVideo;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class CreatePointTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function PointIsCreated()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interests', 0);


        Livewire::test(CreatePoint::class)
            ->set('createForm.distance', '99')
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save');

        $this->assertDatabaseCount('point_of_interests', 1);

        $this->assertDatabaseHas('point_of_interests', [
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }

    /** @test */
    public function DistanceIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interests', 0);

        Livewire::test(CreatePoint::class)
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.distance' => 'required']);

        $this->assertDatabaseCount('point_of_interests', 0);
    }

    /** @test */
    public function LatitudeIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interests', 0);

        Livewire::test(CreatePoint::class)
            ->set('createForm.distance', '99')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.latitude' => 'required']);

        $this->assertDatabaseCount('point_of_interests', 0);
    }

    /** @test */
    public function LongitudeIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interests', 0);

        Livewire::test(CreatePoint::class)
            ->set('createForm.distance', '99')
            ->set('createForm.latitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.longitude' => 'required']);

        $this->assertDatabaseCount('point_of_interests', 0);
    }

    /** @test */
    public function PlaceIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interests', 0);

        Livewire::test(CreatePoint::class)
            ->set('createForm.distance', '99')
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', '15')
            ->call('save')
            ->assertHasErrors(['createForm.place' => 'required']);

        $this->assertDatabaseCount('point_of_interests', 0);
    }

    /** @test */
    public function PlacesExist()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interests', 0);

        Livewire::test(CreatePoint::class)
            ->set('createForm.distance', '99')
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', '99999')
            ->call('save')
            ->assertHasErrors(['createForm.place' => 'exist']);

        $this->assertDatabaseCount('point_of_interests', 0);
    }

    /** @test */
    public function DistanceIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interests', 0);

        Livewire::test(CreatePoint::class)
            ->set('createForm.distance', 'aaaaaaaa')
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.place' => 'number']);

        $this->assertDatabaseCount('point_of_interests', 0);
    }

    /** @test */
    public function LatitudeIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interests', 0);

        Livewire::test(CreatePoint::class)
            ->set('createForm.distance', '10')
            ->set('createForm.latitude', 'aaaaaaaaaaa')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.place' => 'number']);

        $this->assertDatabaseCount('point_of_interests', 0);
    }

    /** @test */
    public function LongitudeIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interests', 0);

        Livewire::test(CreatePoint::class)
            ->set('createForm.distance', '12')
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', 'aaaaaaaaa')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.place' => 'number']);

        $this->assertDatabaseCount('point_of_interests', 0);
    }
}
