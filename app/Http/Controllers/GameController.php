<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GameScore;

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
}