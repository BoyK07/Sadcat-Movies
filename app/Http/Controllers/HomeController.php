<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tmdb\Client;
use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\MovieRepository;
use Tmdb\Repository\TvRepository;

class HomeController extends Controller
{
    protected $imageHelper;

    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    public function show(Client $client)
    {
        $MVrepository = new MovieRepository($client);
        $TVrepository = new TVrepository($client);
        $popularMV = $MVrepository->getPopular();
        $topRatedMV = $MVrepository->getTopRated();
        $popularTV = $TVrepository->getPopular();
        $topRatedTV = $TVrepository->getTopRated();
        return view('home', ['popularMV' => $popularMV, 'topRatedMV' => $topRatedMV, 'popularTV' => $popularTV, 'topRatedTV' => $topRatedTV, 'imageHelper' => $this->imageHelper]);
    }

    public function redirect(Client $client)
    {
        $MVrepository = new MovieRepository($client);
        $TVrepository = new TVrepository($client);
        $popularMV = $MVrepository->getPopular();
        $topRatedMV = $MVrepository->getTopRated();
        $popularTV = $TVrepository->getPopular();
        $topRatedTV = $TVrepository->getTopRated();
        return redirect()->route('home', ['popularMV' => $popularMV, 'topRatedMV' => $topRatedMV, 'popularTV' => $popularTV, 'topRatedTV' => $topRatedTV, 'imageHelper' => $this->imageHelper]);    
    }
}
