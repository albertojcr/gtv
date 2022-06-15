<?php

namespace Tests\Feature\Livewire\Admin\ThematicArea;

use App\Http\Livewire\Admin\ThematicArea\ThematicAreas;
use App\Models\ThematicArea;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateThematicAreaTest extends TestCase
{
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
    public function itDoesNotUpdateAThematicAreaThatExceedsTheMaxLengthInTheName()
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
            ->set('editForm.name', \str_repeat('a', 46))
            ->set('editForm.description', 'Descripción actualizada')
            ->call('update', $thematicArea)
            ->assertHasErrors(['editForm.name' => 'max']);

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => $thematicArea->id,
            'name' => $thematicArea->name,
            'description' => $thematicArea->description,
        ]);
    }

    /** @test */
    public function itDoesNotUpdateAThematicAreaThatExceedsTheMaxLengthInTheDescription()
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
            ->set('editForm.description', \str_repeat('a', 2001))
            ->call('update', $thematicArea)
            ->assertHasErrors(['editForm.description' => 'max']);

        $this->assertDatabaseCount('thematic_areas', 1);

        $this->assertDatabaseHas('thematic_areas', [
            'id' => $thematicArea->id,
            'name' => $thematicArea->name,
            'description' => $thematicArea->description,
        ]);
    }
}
