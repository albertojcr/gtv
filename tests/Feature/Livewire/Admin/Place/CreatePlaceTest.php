<?php

namespace Tests\Feature\Livewire\Admin\Place;

use App\Http\Livewire\Admin\Places\CreatePlace;
use Livewire\Livewire;
use Tests\TestCase;

class CreatePlaceTest extends TestCase
{
    public function testICanCreateAPlace()
    {
        $adminUser = $this->createAdmin();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('places', 0);

        Livewire::test(CreatePlace::class)
            ->set('createForm.name', 'name')
            ->set('createForm.description', 'Place description')
            ->call('save');

        $this->assertDatabaseCount('places', 1);

        $this->assertDatabaseHas('places', [
            'name' => 'name',
            'description' => 'Place description',
        ]);
    }

    public function testNameFieldIsRequiredWhenCreatingAPlace()
    {
        $adminUser = $this->createAdmin();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('places', 0);

        Livewire::test(CreatePlace::class)
            ->set('createForm.name', '')
            ->set('createForm.description', 'Place description')
            ->call('save')
            ->assertHasErrors(['createForm.name' => 'required']);

        $this->assertDatabaseCount('places', 0);
    }

    public function testDescriptionFieldIsRequiredWhenCreatingAPlace()
    {
        $adminUser = $this->createAdmin();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('places', 0);

        Livewire::test(CreatePlace::class)
            ->set('createForm.name', 'name')
            ->set('createForm.description', '')
            ->call('save')
            ->assertHasErrors(['createForm.description' => 'required']);

        $this->assertDatabaseCount('place', 0);
    }
}
