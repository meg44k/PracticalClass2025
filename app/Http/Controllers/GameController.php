<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GameScore;

use App\Models\User;

class GameController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            GameScore::create([
                'id' => $user->id,
                'score' => $request->input('score'),
                'type_count' => $request->input('type_count'),
                'missed_type_count' => $request->input('missed_type_count'),
            ]);
        }

        return response()->json(['message' => 'Game result saved successfully.']);
    }

    public function showMypage()
    {
        $user = Auth::user();
        $gameScores = GameScore::where('id', $user->id)
                               ->orderByDesc('score')
                               ->get();

        $worldRanking = GameScore::with('user')
                                 ->selectRaw('id, MAX(score) as high_score')
                                 ->groupBy('id')
                                 ->orderByDesc('high_score')
                                 ->get();

        return view('mypage', compact('gameScores', 'worldRanking'));
    }
}