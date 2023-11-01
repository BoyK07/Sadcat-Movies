<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tmdb\Client;
use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\MovieRepository;
use Tmdb\Repository\TvRepository;
use App\Models\Watchlist;
use Illuminate\Support\Facades\Auth;
use Tmdb\Repository\TvSeasonRepository;



class InfoController extends Controller
{
    protected $imageHelper;

    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    private function gatherData($repository, $tvSrepo=null, $id, $indicator, $client)
    {
        $description = $repository->load($id)->getOverview();
        $seasons = null;
        if ($indicator == "mv") {
            $release = $repository->load($id)->getReleaseDate()->format('Y');
            $title = $repository->load($id)->getTitle();
        } else {
            $release = $repository->load($id)->getFirstAirDate()->format('Y');
            $seasons = $repository->load($id)->getSeasons();
            $title = $repository->load($id)->getName();
        }
        $suggested = $repository->getSimilar($id);
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

        $duration = null;
        if ($indicator == "mv") {
            $duration = $repository->load($id)->getRuntime();
            $hours = floor($duration / 60);
            $minutes = $duration % 60;
            $duration = ($hours > 0 ? $hours . ' h ' : '') . $minutes . ' min';
        } 

        $userId = Auth::id();
        $isInWatchlist = Watchlist::where('user_id', $userId)
                                ->where('tmdb_id', $id)
                                ->exists();
        $isInWatchlist = $isInWatchlist ? true : false;

        return [
            'id' => $id,
            'title' => $title,
            'logo' => $logo,
            'backimage' => $backimage,
            'description' => $description,
            'release' => $release,
            'duration' => $duration,
            'genres' => $genres,
            'suggested' => $suggested,
            'seasons' => $seasons,
            'imageHelper' => $this->imageHelper,
            'tvsrepo' => $tvSrepo,
            'isInWatchlist' => $isInWatchlist
        ];
    }

    public function showMV(Request $request, Client $client)
    {
        $id = $request->id;
        if (!isset($id)) {
            return redirect()->route('home');
        }
        $repository = new MovieRepository($client);
        $indicator = "mv";
        $data = $this->gatherData($repository, null, $id, $indicator, $client);
        $data['episodes_count'] = null;
        $data['seasons_count'] = null;
        return view('info.movie', $data);
    }

    public function showTV(Request $request, Client $client)
    {
        $id = $request->id;
        if (!isset($id)) {
            return redirect()->route('home');
        }
        $repository = new TvRepository($client);
        $tvSrepo = new TvSeasonRepository($client);
        $indicator = "tv";
        $episodes_count = $repository->load($id)->getNumberOfEpisodes();
        $seasons_count = $repository->load($id)->getNumberOfSeasons();
        $data = $this->gatherData($repository, $tvSrepo, $id, $indicator, $client);
        $data['episodes_count'] = $episodes_count;
        $data['seasons_count'] = $seasons_count;
        return view('info.show', $data);
    }
}