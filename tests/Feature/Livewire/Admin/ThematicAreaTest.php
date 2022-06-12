<?php

namespace Tests\Feature\Livewire\Admin;

use App\Http\Livewire\Admin\ThematicAreas;
use App\Models\ThematicArea;
use Livewire\Livewire;
use Tests\TestCase;

class ThematicAreaTest extends TestCase
{
    /** @test */
    public function itShowsTheThematicAreas()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);

        $thematicArea1 = $this->createThematicArea($pointOfInterest->id);
        $thematicArea2 = $this->createThematicArea($pointOfInterest->id);

        $this->actingAs($adminUser);

        $this->get('areas-tematicas')
            ->assertOk()
            ->assertSeeInOrder([
                $thematicArea1->description,
                $thematicArea2->description,
            ]);
    }

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
    public function itUpdatesAThematicArea()
    {
        $adminUser = $this->createAdmin();

        $thematicArea = factory(ThematicArea::class)->create([
            'name' => 'Nombre',
            'description' => 'Descripción',
        ]);

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => $thematicArea->id,
            'name' => $thematicArea->name,
            'description' => $thematicArea->description,
        ]);

        $this->actingAs($adminUser);

        Livewire::test(ThematicAreas::class)
            ->set('editForm.name', 'Nombre actualizado')
            ->set('editForm.description', 'Descripción actualizada')
            ->call('update', $thematicArea);

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => $thematicArea->id,
            'name' => 'Nombre actualizado',
            'description' => 'Descripción actualizada',
        ]);
    }

    /** @test */
    public function itUpdatesAThematicAreaWithAnEmptyName()
    {
        $adminUser = $this->createAdmin();

        $thematicArea = factory(ThematicArea::class)->create([
            'name' => 'Nombre',
            'description' => 'Descripción',
        ]);

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => $thematicArea->id,
            'name' => $thematicArea->name,
            'description' => $thematicArea->description,
        ]);

        $this->actingAs($adminUser);

        Livewire::test(ThematicAreas::class)
            ->set('editForm.name', '')
            ->set('editForm.description', 'Descripción actualizada')
            ->call('update', $thematicArea);

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => $thematicArea->id,
            'name' => '',
            'description' => 'Descripción actualizada',
        ]);
    }

    /** @test */
    public function itUpdatesAThematicAreaWithAnEmptyDescription()
    {
        $adminUser = $this->createAdmin();

        $thematicArea = factory(ThematicArea::class)->create([
            'name' => 'Nombre',
            'description' => 'Descripción',
        ]);

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => $thematicArea->id,
            'name' => $thematicArea->name,
            'description' => $thematicArea->description,
        ]);

        $this->actingAs($adminUser);

        Livewire::test(ThematicAreas::class)
            ->set('editForm.name', 'Nombre actualizado')
            ->set('editForm.description', '')
            ->call('update', $thematicArea);

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => $thematicArea->id,
            'name' => 'Nombre actualizado',
            'description' => '',
        ]);
    }

    /** @test */
    public function itDeletesAThematicArea()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);

        $thematicArea = $this->createThematicArea($pointOfInterest->id);

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => $thematicArea->id,
            'name' => $thematicArea->name,
            'description' => $thematicArea->description,
        ]);

        Livewire::test(ThematicAreas::class)
            ->call('delete', $thematicArea);

        $this->assertDatabaseCount('videos', 0);
    }
}
