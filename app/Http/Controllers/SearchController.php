<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tmdb\Client;
use Tmdb\Helper\ImageHelper;

class SearchController extends Controller
{
    protected $imageHelper;
    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    public function show()
    {
        return view('search.index');
    }

    public function search(Request $request, Client $client)
{
    $query = $request->input('search');
    if (empty($query)) {
        return redirect()->route('search.show');
    }
    $results = $client->getSearchApi()->searchMulti($query);
    return view('search.result')->with([
        'results' => $results,
        'imageHelper' => $this->imageHelper,
    ]);
}

}
