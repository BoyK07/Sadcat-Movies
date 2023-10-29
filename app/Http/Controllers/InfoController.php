<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tmdb\Client;
use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\MovieRepository;

class InfoController extends Controller
{
    protected $imageHelper;

    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    public function showMV(Request $request, Client $client){
        $id = $request->id;
        if (!isset($id)){
            return redirect()->route('home');
        }
        $repository = new MovieRepository($client);
        $description = $repository->load($id)->getOverview();
        $release = $repository->load($id)->getReleaseDate()->format('Y');
        
        $genresArray = ($repository->load($id)->getGenres())->toArray();
        $genres = [];
        foreach ($genresArray as $genre) {
            if (method_exists($genre, 'getName')) {
                $genres[] = $genre->getName();
            }
        }

        $image = $repository->getImages($id);
        $logo = null;
        $backimage = null;

        foreach ($image as $img) {
            if ($img instanceof \Tmdb\Model\Image\LogoImage && $img->getIso6391() === 'en') {
                $logo = $img->getFilePath();
                break;
            }
        }

        if (!$logo) {
            foreach ($image as $img) {
                if ($img instanceof \Tmdb\Model\Image\LogoImage) {
                    $logo = $img->getFilePath();
                    break;
                }
            }
        }

        if (!$backimage) {
            foreach ($image as $img) {
                $backimage = $img->getFilePath();
                break;
            }
        }

        return view('info')->with(compact('description', 'backimage', 'logo', 'release', 'genres'));
    }

    public function showTV(Request $request, Client $client){
        $id = $request->id;
        if (!isset($id)){
            return redirect()->route('home');
        }
        $info = null;
        return view('info')->with('info', $info);
    }
}