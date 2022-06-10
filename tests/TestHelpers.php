<?php

namespace Tests;

use App\Models\Place;
use App\Models\PointOfInterest;
use App\Models\ThematicArea;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoItem;
use Faker\Factory;
use Spatie\Permission\Models\Role;

trait TestHelpers
{
    protected function createAdmin()
    {
        $adminRole = Role::create(['name' => 'Administrador']);

        $user = new User;
        $user->login = 'admin';
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->salt = 'salt-here';
        $user->email = 'admin@mail.com';
        $user->profile = 'Profile description here';
        $user->save();
        $user->assignRole($adminRole);

        return $user;
    }

    protected function createPlace()
    {
        return \factory(Place::class)->create();
    }

    protected function createPointOfInterest($placeId)
    {
        return \factory(PointOfInterest::class)->create([
            'place_id' => $placeId,
        ]);
    }

    protected function createThematicArea($pointOfInterestId)
    {
        $faker = Factory::create();

        $thematicArea = \factory(ThematicArea::class)->create();

        $thematicArea->pointsOfInterest()->attach($pointOfInterestId, [
            'title' => $faker->sentence,
            'description' => $faker->text,
        ]);

        return $thematicArea;
    }

    protected function createVideo()
    {
        $video = \factory(Video::class)->create();

        \factory(VideoItem::class)->create([
            'video_id' => $video->id,
        ]);

        return $video;
    }
}