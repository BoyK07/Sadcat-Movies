<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\History;

class PlayerController extends Controller
{
    public function add(Request $request, $tmdb_id)
    {
        if (!$request->input('season')) {
            $season = 1;
        } if (!$request->input('episode')) {
            $episode = 1;
        } else {
            $season = $request->input('season');
            $episode = $request->input('episode');
        }
        $user = Auth::user();

        // If user is logged in
        if ($user) {
            $history = History::where('user_id', $user->id)->where('tmdb_id', $tmdb_id)->first();
            if (!$history) {
                $validatedData = $request->validate([
                    'title' => 'required|string|max:255',
                    'type' => 'required|string',
                    'imageurl' => 'required|string',
                    'logo_url' => 'required|string',
                    'tmdb_id' => 'required|integer',
                ]);

                History::create([
                    'user_id' => $user->id,
                    'title' => $validatedData['title'],
                    'type' => $validatedData['type'],
                    'imageurl' => $validatedData['imageurl'],
                    'logo_url' => $validatedData['logo_url'],
                    'tmdb_id' => $validatedData['tmdb_id']
                ]);
            }
        }

        // Redirect both logged-in and guest users to the player
        return $this->show($request, $tmdb_id, $season, $episode);
    }

    public function show(Request $request, $tmdb_id, $season, $episode)
    {
        return view('player.index', [
            'tmdb_id' => $tmdb_id,
            'type' => $request->input('type'),
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}