<?php

namespace App\Http\Controllers\Admin;

use App\Charts\GraphicChart;
use App\Http\Controllers\Controller;
use App\Models\Photography;
use App\Models\PointOfInterest;
use App\Models\User;
use App\Models\Video;
use App\Models\Visit;

class AdminController extends Controller
{
    public function index()
    {
        $numberUsers = User::countNewUsers();
        $photos = Photography::countNewPhotos();
        $videos = Video::countNewVideos();
        $numberPointsOfInterest =PointOfInterest::countNewPointsOfInterest();


        $visits = Visit::DatesForGrafic();
        $chartVisit = $this->createChart($visits, 'Visitas', 'line', 'rgba(255, 99, 132, 0.2)', '#F96332');

        $pointsOfInterest = PointOfInterest::datesForGrafic();
        $chartPointOfInterest = $this->createChart($pointsOfInterest, 'Punto de intereses', 'bar', 'rgba( 208, 73, 0, 0.4)', '#F96332');

        $mostVisits = Visit::getPointsOfInterestMostVisit();
        $pointsOfInterestMostVisits = $this->getPointsOfInterest($mostVisits);

        return view('admin.dashboard', compact(['numberUsers', 'pointsOfInterestMostVisits', 'numberPointsOfInterest', 'chartVisit', 'chartPointOfInterest', 'photos', 'videos']));
    }

    private function createChart($data, $name, $type, $backgroundColor, $color)
    {
        $valores = $this->getValuesFromArray($data);
        $chart = new GraphicChart();
        $chart->displayLegend(false);
        $chart->labels(array_reverse($valores[0]));
        $chart->dataset($name, $type, array_reverse($valores[1]))->backgroundcolor($backgroundColor)->color($color);
        return $chart;
    }

    private function getValuesFromArray($array)
    {
        $i = 0;
        $result = [];
        foreach ($array as $key => $value) {
            $result[0][$i] = $key;
            $result[1][$i] = count($value);
            $i++;
        }
        return $result;
    }

    private function getPointsOfInterest($array)
    {
        $i = 0;
        $result = [];
        foreach ($array as $key => $value) {
            $result[] = PointOfInterest::find($key);
        }

        return array_reverse($result);
    }
}
