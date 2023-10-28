<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tmdb\Client;
use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\MovieRepository;

class HomeController extends Controller
{
    protected $imageHelper;

    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    public function show(Client $client)
    {
        $repository = new MovieRepository($client);
        $popular = $repository->getPopular();

        return view('home', ['movies' => $popular, 'imageHelper' => $this->imageHelper]);
    }
}
