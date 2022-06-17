<?php

namespace App\Http\Livewire;

use App\Models\Video;
use App\Models\ThematicArea;
use App\Models\User;
use App\Models\Visit;
use App\Models\PointOfInterest;
use App\Models\Place;
use App\Models\Photography;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Welcome extends Component
{
    public $listeners = ['delete', 'render'];
    public $countvideos;
    public $countareas;
    public $countusers;
    public $countvisits;
    public $countpoints;
    public $countplaces;
    public $countphotographies;
    public $nombreUsuario;

    public $search;
    public $searchColumn = 'id';

    public $sortField = 'id';
    public $sortDirection = 'desc';

    protected $queryString = ['search'];


    public $detailsModalVideos = [
        'open' => false,
        'id' => null,
        'description' => null,
        'route' => null,
        'order' => null,
        'pointOfInterest' => null,
        'thematicAreaName' => null,
        'thematicAreaId' => null,
        'creatorName' => null,
        'creatorId' => null,
        'updaterName' => null,
        'updaterId' => null,
        'createdAt' => null,
        'updatedAt' => null,
    ];

    public $detailsModalAreas = [
        'open' => false,
        'id' => null,
        'name' => null,
        'description' => null,
        'createdAt' => null,
        'updatedAt' => null,
    ];

    public $detailsModalUsers = [
        'open' => false,
        'avatar' => null,
        'id' => null,
        'name' => '',
        'email' => '',
        'rol' => '',
        'password' => '',
        'emailVerifiedAt' => '',
        'createdAt' => '',
        'updatedAt' => '',
    ];

    public $detailsModalVisits = [
        'open' => false,
        'id' => null,
        'hour' => null,
        'deviceid' => null,
        'appversion' => null,
        'useragent' => null,
        'ssoo' => null,
        'ssooversion' => null,
        'latitude' => null,
        'longitude' => null,
        'point_of_interest_id' => null,
    ];

    public $detailsModalPoints = [
        'open' => false,
        'id' => null,
        'distance' => null,
        'latitude' => null,
        'longitude' => null,
        'placeId' => null,
        'placeName' => null,
        'creatorName' => null,
        'creatorId' => null,
        'updaterName' => null,
        'updaterId' => null,
        'createdAt' => null,
        'updatedAt' => null,
    ];

    public $detailsModalPlaces = [
        'open' => false,
        'id' => null,
        'name' => null,
        'description' => null,
        'creatorName' => null,
        'creatorId' => null,
        'updaterName' => null,
        'updaterId' => null,
        'deletedAt' => null,
        'createdAt' => null,
        'updatedAt' => null,
    ];

    public $detailsModalPhotographies = [
        'open' => false,
        'id' => null,
        'route' => null,
        'order' => null,
        'pointOfInterestId' => null,
        'thematicAreaId' => null,
        'thematicAreaName' => null,
        'creatorId' => null,
        'creatorName' => null,
        'updaterId' => null,
        'updaterName' => null,
        'createdAt' => null,
        'updatedAt' => null,
    ];

    public function showVideos(Video $video)
    {
        $this->detailsModalVideos['open'] = true;
        $this->detailsModalVideos['id'] = $video->id;
        $this->detailsModalVideos['description'] = $video->description;
        $this->detailsModalVideos['route'] = Storage::url($video->route);
        $this->detailsModalVideos['order'] = $video->order;
        $this->detailsModalVideos['pointOfInterest'] = $video->pointOfInterest->id;
        $this->detailsModalVideos['thematicAreaName'] = $video->thematicArea->name ?? '';
        $this->detailsModalVideos['thematicAreaId'] = $video->thematicArea->id ?? '';
        $this->detailsModalVideos['creatorName'] = User::find($video->creator)->name;
        $this->detailsModalVideos['creatorId'] = $video->creator;
        $this->detailsModalVideos['updaterName'] = $video->updater ? User::find($video->updater)->name : null;;
        $this->detailsModalVideos['updaterId'] = $video->updater;
        $this->detailsModalVideos['createdAt'] = $video->created_at;
        $this->detailsModalVideos['updatedAt'] = $video->updated_at;
    }

    public function showAreas(ThematicArea $thematicArea)
    {
        $this->detailsModalAreas['open'] = true;
        $this->detailsModalAreas['id'] = $thematicArea->id;
        $this->detailsModalAreas['name'] = $thematicArea->name;
        $this->detailsModalAreas['description'] = $thematicArea->description;
        $this->detailsModalAreas['createdAt'] = $thematicArea->created_at;
        $this->detailsModalAreas['updatedAt'] = $thematicArea->updated_at;
    }

    public function showUsers(User $user)
    {
        $this->detailsModalUsers['open'] = true;
        if ($user->profile_photo_path) {
            $this->detailsModalUsers['avatar'] = Storage::url($user->profile_photo_path);
        }
        $this->detailsModalUsers['id'] = $user->id;
        $this->detailsModalUsers['name'] = $user->name;
        $this->detailsModalUsers['email'] = $user->email;
        $this->detailsModalUsers['password'] = $user->password;
        $this->detailsModalUsers['rol'] = $user->roles->first()->name;
        $this->detailsModalUsers['emailVerifiedAt'] = $user->email_verified_at;
        $this->detailsModalUsers['createdAt'] = $user->created_at;
        $this->detailsModalUsers['updatedAt'] = $user->updated_at;
    }

    public function showVisits(Visit $visit)
    {
        $this->detailsModalVisits['open'] = true;
        $this->detailsModalVisits['id'] = $visit->id;
        $this->detailsModalVisits['hour'] = $visit->hour;
        $this->detailsModalVisits['deviceid'] = $visit->deviceid;
        $this->detailsModalVisits['appversion'] = $visit->appversion;
        $this->detailsModalVisits['useragent'] = $visit->useragent;
        $this->detailsModalVisits['ssoo'] = $visit->ssoo;
        $this->detailsModalVisits['ssooversion'] = $visit->ssooversion;
        $this->detailsModalVisits['latitude'] = $visit->latitude;
        $this->detailsModalVisits['longitude'] = $visit->longitude;
        $this->detailsModalVisits['point_of_interest_id'] = $visit->pointOfInterest;
        $this->detailsModalVisits['createdAt'] = $visit->created_at;

    }

    public function showPoints(PointOfInterest $point)
    {
        $this->detailsModalPoints['open'] = true;
        $this->detailsModalPoints['id'] = $point->id;
        $this->detailsModalPoints['distance'] = $point->distance;
        $this->detailsModalPoints['latitude'] = $point->latitude;
        $this->detailsModalPoints['longitude'] = $point->longitude;
        $this->detailsModalPoints['placeId'] = $point->place->id;
        $this->detailsModalPoints['placeName'] = $point->place->name;
        $this->detailsModalPoints['creatorName'] = User::find($point->creator)->name;
        $this->detailsModalPoints['creatorId'] = $point->creator;
        $this->detailsModalPoints['updaterName'] = $point->updater ? User::find($point->updater)->name : null;;
        $this->detailsModalPoints['updaterId'] = $point->updater;
        $this->detailsModalPoints['createdAt'] = $point->created_at;
        $this->detailsModalPoints['updatedAt'] = $point->updated_at;
    }

    public function showPlaces(Place $place)
    {
        $this->detailsModalPlaces['open'] = true;
        $this->detailsModalPlaces['id'] = $place->id;
        $this->detailsModalPlaces['name'] = $place->name;
        $this->detailsModalPlaces['description'] = $place->description;
        $this->detailsModalPlaces['creatorName'] = User::find($place->creator)->name;
        $this->detailsModalPlaces['creatorId'] = $place->creator;
        $this->detailsModalPlaces['updaterName'] = $place->updater ? User::find($place->updater)->name : null;
        $this->detailsModalPlaces['updaterId'] = $place->updater;
        $this->detailsModalPlaces['createdAt'] = $place->created_at;
        $this->detailsModalPlaces['updatedAt'] = $place->updated_at;
    }

    public function showPhotographies(Photography $photography)
    {
        $this->detailsModalPhotographies['open'] = true;
        $this->detailsModalPhotographies['id'] = $photography->id;
        $this->detailsModalPhotographies['route'] = $photography->route;
        $this->detailsModalPhotographies['order'] = $photography->order;
        $this->detailsModalPhotographies['pointOfInterestId'] = $photography['point_of_interest_id'];
        $this->detailsModalPhotographies['thematicAreaId'] = $photography->thematicArea->id ?? '';
        $this->detailsModalPhotographies['thematicAreaName'] = $photography->thematicArea->name ?? '';
        $this->detailsModalPhotographies['creatorId'] = User::find($photography->creator)->id;
        $this->detailsModalPhotographies['creatorName'] = User::find($photography->creator)->name;
        $this->detailsModalPhotographies['createdAt'] = $photography->created_at;
        $this->detailsModalPhotographies['updatedAt'] = $photography->updated_at;
    }

    public function mount() {

        if(auth()->user()->hasRole('Alumno')) {
            $this->countvideos = Video::where('creator', auth()->user()->id)->count();
        } else {
            $this->countvideos = Video::all()->count();
        }

        if(auth()->user()->hasRole('Administrador')
            || auth()->user()->hasRole('Profesor')) {

            $this->countareas = ThematicArea::all()->count();
        }

        if(auth()->user()->hasRole('Administrador')
            || auth()->user()->hasRole('Profesor')) {

            $this->countusers = User::all()->count();
        }

        if(auth()->user()->hasRole('Administrador')
            || auth()->user()->hasRole('Profesor')) {

            $this->countvisits = Visit::all()->count();
        }

        if(auth()->user()->hasRole('Alumno')) {
            $this->countpoints = PointOfInterest::where('creator', auth()->user()->id)->count();
        } else {
            $this->countpoints = PointOfInterest::all()->count();
        }

        if(auth()->user()->hasRole('Alumno')) {
            $this->countplaces = Place::where('creator', auth()->user()->id)->count();
        } else {
            $this->countplaces = Place::all()->count();
        }

        if(auth()->user()->hasRole('Alumno')) {
            $this->countphotographies = Photography::where('creator', auth()->user()->id)->count();
        } else {
            $this->countphotographies = Photography::all()->count();
        }

    }

    public function render()
    {
        if (auth()->user()->hasRole('Alumno')) {
            $videos = Video::where('creator', auth()->user()->id)
                ->orderByDesc('id')
                ->paginate(3);
        } else {
            $videos = Video::orderByDesc('id')
                ->paginate(3);
        }

        if(auth()->user()->hasRole('Administrador')
            || auth()->user()->hasRole('Profesor')) {

            $thematicAreas = ThematicArea::where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(3);
        }

        if(auth()->user()->hasRole('Administrador')
            || auth()->user()->hasRole('Profesor')) {

            $users = User::where('email', '<>', auth()->user()->email)
                ->orderBy('id')
                ->paginate(3);
        }

        if(auth()->user()->hasRole('Administrador')
            || auth()->user()->hasRole('Profesor')) {

            $visits = Visit::orderByDesc('id')
                ->paginate(3);
        }

        if (auth()->user()->hasRole('Alumno')) {
            $points = PointOfInterest::where('creator', auth()->user()->id)
                ->orderByDesc('id')
                ->paginate(3);
        } else {
            $points = PointOfInterest::orderByDesc('id')
                ->paginate(3);
        }

        if( ! auth()->user()->hasRole('Alumno')) {
            $places = Place::orderByDesc('id')
                ->paginate(3);
        }

        if (auth()->user()->hasRole('Profesor')){
            $photographies = Photography::where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(3);
        } else if (auth()->user()->hasRole('Alumno')) {
            $photographies = Photography::where('creator', auth()->user()->id)
                ->where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(3);
        } else {
            $photographies = Photography::where($this->searchColumn, 'like', '%'. $this->search .'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(3);
        }

        if(auth()->user()->hasRole('Administrador')
            || auth()->user()->hasRole('Profesor')) {

            return view('livewire.welcome', compact('videos', 'thematicAreas', 'users', 'visits', 'points', 'places', 'photographies'));
        }else{
            return view('livewire.welcome', compact('videos',  'points', 'photographies'));
        }

    }
}
