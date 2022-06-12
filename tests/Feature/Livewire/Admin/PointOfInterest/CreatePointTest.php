<?php

namespace Tests\Feature\Livewire\Admin\PointOfInterest;

use App\Http\Livewire\Admin\Video\CreateVideo;
use App\Models\Video;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class CreatePointTest extends TestCase
{
    public function PointIsCreated()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interest', 0);


        Livewire::test(CreateVideo::class)
            ->set('createForm.distance', '99')
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save');

        $this->assertDatabaseCount('point_of_interest', 1);

        $this->assertDatabaseHas('point_of_interest', [
            'place_id' => $place->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }

    public function DistanceIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interest', 0);

        Livewire::test(CreateVideo::class)
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.distance' => 'required']);

        $this->assertDatabaseCount('point_of_interest', 0);
    }

    public function LatitudeIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interest', 0);

        Livewire::test(CreateVideo::class)
            ->set('createForm.distance', '99')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.latitude' => 'required']);

        $this->assertDatabaseCount('point_of_interest', 0);
    }

    public function LongitudeIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interest', 0);

        Livewire::test(CreateVideo::class)
            ->set('createForm.distance', '99')
            ->set('createForm.latitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.longitude' => 'required']);

        $this->assertDatabaseCount('point_of_interest', 0);
    }

    public function PlaceIsRequired()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interest', 0);

        Livewire::test(CreateVideo::class)
            ->set('createForm.distance', '99')
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', '15')
            ->call('save')
            ->assertHasErrors(['createForm.place' => 'required']);

        $this->assertDatabaseCount('point_of_interest', 0);
    }

    public function PlacesExist()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interest', 0);

        Livewire::test(CreateVideo::class)
            ->set('createForm.distance', '99')
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', '99999')
            ->call('save')
            ->assertHasErrors(['createForm.place' => 'exist']);

        $this->assertDatabaseCount('point_of_interest', 0);
    }

    public function DistanceIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interest', 0);

        Livewire::test(CreateVideo::class)
            ->set('createForm.distance', 'aaaaaaaa')
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.place' => 'number']);

        $this->assertDatabaseCount('point_of_interest', 0);
    }

    public function LatitudeIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interest', 0);

        Livewire::test(CreateVideo::class)
            ->set('createForm.distance', '10')
            ->set('createForm.latitude', 'aaaaaaaaaaa')
            ->set('createForm.longitude', '15')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.place' => 'number']);

        $this->assertDatabaseCount('point_of_interest', 0);
    }

    public function LongitudeIsANumber()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('point_of_interest', 0);

        Livewire::test(CreateVideo::class)
            ->set('createForm.distance', '12')
            ->set('createForm.latitude', '10')
            ->set('createForm.longitude', 'aaaaaaaaa')
            ->set('createForm.place', $place->id)
            ->call('save')
            ->assertHasErrors(['createForm.place' => 'number']);

        $this->assertDatabaseCount('point_of_interest', 0);
    }
}
