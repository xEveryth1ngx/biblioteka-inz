<?php

namespace App\Http\Controllers;

use App\Models\IP;
use App\Models\SiteEntrance;
use Illuminate\Http\Request;

class SiteEntranceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $ip = IP::firstOrCreate([
            'ip' => $request->ip(),
        ]);

        $entrance = SiteEntrance::where([
            'ip_id' => $ip->id,
        ])->where(
            'created_at',
            '>=',
            now()->subMinutes(10)
        )->first();

        if (!$entrance) {
            $entrance = SiteEntrance::create([
                'ip_id' => $ip->id,
            ]);
        }

        $entrance->save();

        return response()->json([
            'message' => 'success',
        ]);
    }
}
