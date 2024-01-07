<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        return view('track');
    }

    public function store(Request $request): JsonResponse
    {
        $track = Track::create([
            'data' => $request->getContent(),
        ]);
//        $track->data = "test";
//        dd($track);
        $track->save();

        return response()->json(['status' => 'success']);
    }
}
