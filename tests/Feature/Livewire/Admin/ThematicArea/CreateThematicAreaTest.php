<?php

namespace Tests\Feature\Livewire\Admin\ThematicArea;

use App\Http\Livewire\Admin\ThematicArea\ThematicAreas;
use App\Models\ThematicArea;
use Livewire\Livewire;
use Tests\TestCase;

class CreateThematicAreaTest extends TestCase
{
    /** @test */
    public function itCreatesAThematicArea()
    {
        $adminUser = $this->createAdmin();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('thematic_areas', 0);

        Livewire::test(ThematicAreas::class)
            ->set('createForm.name', 'Nombre')
            ->set('createForm.description', 'Descripción')
            ->call('save');

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => 1,
            'name' => 'Nombre',
            'description' => 'Descripción',
        ]);
    }

    /** @test */
    public function itCreatesAThematicAreaWithEmptyName()
    {
        $adminUser = $this->createAdmin();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('thematic_areas', 0);

        Livewire::test(ThematicAreas::class)
            ->set('createForm.name', '')
            ->set('createForm.description', 'Descripción')
            ->call('save');

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => 1,
            'name' => '',
            'description' => 'Descripción',
        ]);
    }

    /** @test */
    public function itCreatesAThematicAreaWithEmptyDescription()
    {
        $adminUser = $this->createAdmin();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('thematic_areas', 0);

        Livewire::test(ThematicAreas::class)
            ->set('createForm.name', 'Nombre')
            ->set('createForm.description', '')
            ->call('save');

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => 1,
            'name' => 'Nombre',
            'description' => '',
        ]);
    }

    /** @test */
    public function itDoesNotCreateAThematicAreaThatExceedsTheMaxLengthInTheName()
    {
        $adminUser = $this->createAdmin();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('thematic_areas', 0);

        Livewire::test(ThematicAreas::class)
            ->set('createForm.name', \str_repeat('a', 46))
            ->set('createForm.description', 'Descripción')
            ->call('save')
            ->assertHasErrors(['createForm.name' => 'max']);

        $this->assertDatabaseCount('thematic_areas', 0);
    }

    /** @test */
    public function itDoesNotCreateAThematicAreaThatExceedsTheMaxLengthInTheDescription()
    {
        $adminUser = $this->createAdmin();

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('thematic_areas', 0);

        Livewire::test(ThematicAreas::class)
            ->set('createForm.name', 'Nombre')
            ->set('createForm.description', \str_repeat('a', 2001))
            ->call('save')
            ->assertHasErrors(['createForm.description' => 'max']);

        $this->assertDatabaseCount('thematic_areas', 0);
    }
}
