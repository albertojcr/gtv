<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\Photography\Photographies;
use App\Models\Photography;
use Livewire\Livewire;
use Tests\TestCase;

class UpdatePhotographyTest extends TestCase
{
    /** @test */
    public function itUpdatesAPhotography()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);

        $photographyA = factory(Photography::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
        ]);

        $this->assertDatabaseCount('photographies', 1);

        $this->assertDatabaseHas('photographies', [
            'id' => $photographyA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $thematicAreaB = $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(Photographies::class)
            ->set('editForm.pointOfInterestId', $pointOfInterestB->id)
            ->set('editForm.thematicAreaId', $thematicAreaB->id)
            ->call('update', $photographyA);

        $this->assertDatabaseCount('photographies', 1);

        $this->assertDatabaseHas('photographies', [
            'id' => $photographyA->id,
            'point_of_interest_id' => $pointOfInterestB->id,
            'thematic_area_id' => $thematicAreaB->id,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
        ]);
    }

    /** @test */
    public function itChecksThatThePointOfInterestFieldIsRequiredWhenUpdatingAPhotography()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);

        $photographyA = factory(Photography::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
        ]);

        $this->assertDatabaseCount('photographies', 1);

        $this->assertDatabaseHas('photographies', [
            'id' => $photographyA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $thematicAreaB = $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(Photographies::class)
            ->set('editForm.thematicAreaId', $thematicAreaB->id)
            ->call('update', $photographyA)
            ->assertHasErrors(['editForm.pointOfInterestId' => 'required']);

        $this->assertDatabaseCount('photographies', 1);

        $this->assertDatabaseHas('photographies', [
            'id' => $photographyA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }

    /** @test */
    public function itChecksThatTheThematicAreaFieldIsRequiredWhenUpdatingAPhotography()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);

        $photographyA = factory(Photography::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
        ]);

        $this->assertDatabaseCount('photographies', 1);

        $this->assertDatabaseHas('photographies', [
            'id' => $photographyA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $thematicAreaB = $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(Photographies::class)
            ->call('update', $photographyA)
            ->assertHasErrors(['editForm.thematicAreaId' => 'required']);

        $this->assertDatabaseCount('photographies', 1);

        $this->assertDatabaseHas('photographies', [
            'id' => $photographyA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }

    /** @test */
    public function itChecksThatTheThematicAreaFieldIsAnIntegerdWhenUpdatingAPhotography()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);

        $photographyA = factory(Photography::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
        ]);

        $this->assertDatabaseCount('photographies', 1);

        $this->assertDatabaseHas('photographies', [
            'id' => $photographyA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $thematicAreaB = $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(Photographies::class)
            ->set('editForm.pointOfInterestId', $pointOfInterestB->id)
            ->set('editForm.thematicAreaId', 'asd')
            ->call('update', $photographyA)
            ->assertHasErrors(['editForm.thematicAreaId' => 'integer']);

        $this->assertDatabaseCount('photographies', 1);

        $this->assertDatabaseHas('photographies', [
            'id' => $photographyA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'creator' => $adminUser->id,
            'updater' => null,
        ]);
    }
}
