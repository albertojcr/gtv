<?php

namespace Tests\Feature\Livewire\Admin\Place;

use App\Http\Livewire\Admin\Places\ListPlaces;
use Livewire\Livewire;
use Tests\TestCase;

class DeletePlaceTest extends TestCase
{
    public function testICanDeleteAnExistingPlace()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('places', 1);

        $this->assertDatabaseHas('places', [
            'name' => $place->name,
            'description' => $place->description,
        ]);

        Livewire::test(ListPlaces::class)
            ->call('delete', $place);

        $this->assertDatabaseCount('places', 0);
    }
}
