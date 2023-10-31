<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Watchlist;

class WatchlistController extends Controller
{
    public function add(Request $request) {
        $user = Auth::user();
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'tmdb_id' => 'required|integer',
        ]);
        
        Watchlist::create([
            'user_id' => $user->id,
            'title' => $validatedData['title'],
            'type' => $validatedData['type'],
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
