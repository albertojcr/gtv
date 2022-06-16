<?php

namespace Tests\Feature\Livewire\Admin\Place;

use App\Http\Livewire\Admin\Places\EditPlace;
use App\Models\Place;
use Livewire\Livewire;
use Tests\TestCase;

class UpdatePlaceTest extends TestCase
{
    public function testICanUpdateAnExistingPlace()
    {
        $adminUser = $this->createAdmin();
        $placeA = factory(Place::class)->create([
            'name' => 'Place A',
            'description' => 'Initial description',
        ]);

        $this->assertDatabaseCount('places', 1);
        $this->assertDatabaseHas('places', [
            'name' => $placeA->name,
            'description' => $placeA->description,
        ]);

        $this->actingAs($adminUser);

        Livewire::test(EditPlace::class)
            ->set('editForm.name', 'New name')
            ->call('update', $placeA)
            ->assertHasErrors(['editForm.description' => 'required']);

        $this->assertDatabaseCount('places', 1);
        $this->assertDatabaseHas('places', [
            'name' => $placeA->name,
            'description' => $placeA->description,
        ]);
    }

    public function testDescriptionFieldIsRequiredWhenUpdatingAPlace()
    {
        $adminUser = $this->createAdmin();
        $placeA = factory(Place::class)->create([
            'name' => 'Place A',
            'description' => 'Initial description',
        ]);

        $this->assertDatabaseCount('places', 1);
        $this->assertDatabaseHas('places', [
            'name' => $placeA->name,
            'description' => $placeA->description,
        ]);

        $this->actingAs($adminUser);

        Livewire::test(EditPlace::class)
            ->set('editForm.description', 'New name')
            ->set('editForm.description', '')
            ->call('update', $placeA)
            ->assertHasErrors(['editForm.description' => 'required']);

        $this->assertDatabaseCount('places', 1);
        $this->assertDatabaseHas('places', [
            'name' => $placeA->name,
            'description' => $placeA->description,
        ]);
    }
}
