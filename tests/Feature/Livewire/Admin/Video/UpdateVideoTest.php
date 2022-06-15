<?php

namespace Tests\Feature\Livewire\Admin\Video;

use App\Http\Livewire\Admin\Video\EditVideo;
use App\Models\Video;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateVideoTest extends TestCase
{
    public function testICanUpdateAnExistingVideoData()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);
        $videoA = factory(Video::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => 'Initial description',
        ]);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $thematicAreaB = $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(EditVideo::class)
            ->set('editForm.pointOfInterest', $pointOfInterestB->id)
            ->set('editForm.thematicArea', $thematicAreaB->id)
            ->set('editForm.description', 'Updated description')
            ->call('update', $videoA);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestB->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => $adminUser->id,
            'thematic_area_id' => $thematicAreaB->id,
            'description' => 'Updated description',
        ]);
    }

    public function testPointOfInterestIsRequiredWhenUpdatingAVideo()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);
        $videoA = factory(Video::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => 'Initial description',
        ]);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $thematicAreaB = $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(EditVideo::class)
            ->set('editForm.thematicArea', $thematicAreaB->id)
            ->set('editForm.description', 'Updated description')
            ->call('update', $videoA)
            ->assertHasErrors(['editForm.pointOfInterest' => 'required']);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);
    }

/*    public function testPointOfInterestExistsInDatabaseWhenUpdatingAVideo()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);
        $videoA = factory(Video::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => 'Initial description',
        ]);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $thematicAreaB = $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(EditVideo::class)
            ->set('editForm.pointOfInterest', '12345')
            ->set('editForm.thematicArea', $thematicAreaB->id)
            ->set('editForm.description', 'Updated description')
            ->call('update', $videoA)
            ->assertHasErrors(['editForm.pointOfInterest' => 'exists']);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);
    }*/

    public function testThematicAreaFieldIsRequiredWhenUpdatingAVideo()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);
        $videoA = factory(Video::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => 'Initial description',
        ]);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(EditVideo::class)
            ->set('editForm.pointOfInterest', $pointOfInterestB->id)
            ->set('editForm.thematicArea', '')
            ->set('editForm.description', 'Updated description')
            ->call('update', $videoA)
            ->assertHasErrors(['editForm.thematicArea' => 'required']);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);
    }

    public function testThematicAreaFieldExistsInDatabaseWhenUpdatingAVideo()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);
        $videoA = factory(Video::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => 'Initial description',
        ]);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(EditVideo::class)
            ->set('editForm.pointOfInterest', $pointOfInterestB->id)
            ->set('editForm.thematicArea', '12345')
            ->set('editForm.description', 'Updated description')
            ->call('update', $videoA)
            ->assertHasErrors(['editForm.thematicArea' => 'exists']);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);
    }

    public function testDescriptionFieldIsRequiredWhenUpdatingAVideo()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);
        $videoA = factory(Video::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => 'Initial description',
        ]);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $thematicAreaB = $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(EditVideo::class)
            ->set('editForm.pointOfInterest', $pointOfInterestB->id)
            ->set('editForm.thematicArea', $thematicAreaB->id)
            ->set('editForm.description', '')
            ->call('update', $videoA)
            ->assertHasErrors(['editForm.description' => 'required']);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);
    }

    public function testDescriptionFieldMustBeAStringWhenUpdatingAVideo()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);
        $videoA = factory(Video::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => 'Initial description',
        ]);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $thematicAreaB = $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(EditVideo::class)
            ->set('editForm.pointOfInterest', $pointOfInterestB->id)
            ->set('editForm.thematicArea', $thematicAreaB->id)
            ->set('editForm.description', 123)
            ->call('update', $videoA)
            ->assertHasErrors(['editForm.description' => 'string']);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);
    }

    public function testDescriptionFieldHasMaxLengthWhenUpdatingAVideo()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();

        $pointOfInterestA = $this->createPointOfInterest($place->id);
        $thematicAreaA = $this->createThematicArea($pointOfInterestA->id);
        $videoA = factory(Video::class)->create([
            'point_of_interest_id' => $pointOfInterestA->id,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => 'Initial description',
        ]);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);

        $this->actingAs($adminUser);

        $pointOfInterestB = $this->createPointOfInterest($place->id);
        $thematicAreaB = $this->createThematicArea($pointOfInterestB->id);

        Livewire::test(EditVideo::class)
            ->set('editForm.pointOfInterest', $pointOfInterestB->id)
            ->set('editForm.thematicArea', $thematicAreaB->id)
            ->set('editForm.description', \str_repeat('a', 2001))
            ->call('update', $videoA)
            ->assertHasErrors(['editForm.description' => 'max']);

        $this->assertDatabaseCount('videos', 1);
        $this->assertDatabaseHas('videos', [
            'id' => $videoA->id,
            'point_of_interest_id' => $pointOfInterestA->id,
            'order' => 1,
            'creator' => $adminUser->id,
            'updater' => null,
            'thematic_area_id' => $thematicAreaA->id,
            'description' => $videoA->description,
        ]);
    }
}
