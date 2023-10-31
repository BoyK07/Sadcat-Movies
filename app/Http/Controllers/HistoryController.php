<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;

class HistoryController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $history = History::where('user_id', $user->id)->get();
        $history = $history->sortByDesc('created_at');
        $history = $history->values()->all();
        return view('history.index', ['history' => $history]);
    }
}
