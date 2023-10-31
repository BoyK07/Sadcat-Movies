<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Watchlist;

class WatchlistController extends Controller
{
    public function show(){
        $user = Auth::user();
        $watchlist = Watchlist::where('user_id', $user->id)->get();
        $watchlist = $watchlist->sortBy('title');
        $watchlist = $watchlist->values()->all();
        return view('watchlist.index', ['watchlist' => $watchlist]);
    }

    public function add(Request $request) {
        $user = Auth::user();
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'imageurl' => 'required|string',
            'logo_url' => 'required|string',
            'tmdb_id' => 'required|integer',
        ]);
        
        Watchlist::create([
            'user_id' => $user->id,
            'title' => $validatedData['title'],
            'type' => $validatedData['type'],
            'imageurl' => $validatedData['imageurl'],
            'logo_url' => $validatedData['logo_url'],
            'tmdb_id' => $validatedData['tmdb_id']
        ]);
        
        return redirect()->back();
    }    

    public function remove(Request $request) {
        $user = Auth::user();    
        $validatedData = $request->validate([
            'tmdb_id' => 'required|integer',
        ]);

        Watchlist::where('user_id', $user->id)
                  ->where('tmdb_id', $validatedData['tmdb_id'])
                  ->delete();
    
        return redirect()->back();
    }    
}
