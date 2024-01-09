<?php

namespace App\Http\Controllers;

use App\Models\IP;
use App\Models\Page;
use App\Models\Scroll;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScrollController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $page = Page::firstOrCreate([
            'url' => $request->get('page'),
        ]);

        $ip = IP::firstOrCreate([
            'ip' => $request->ip(),
        ]);

        // modify the scroll so that it gets a scroll which was created less than 10 minutes ago
        $scroll = Scroll::where([
            'page_id' => $page->id,
            'ip_id' => $ip->id,
        ])->where(
            'created_at',
            '>=',
            now()->subMinutes(10)
        )->first();

        if (!$scroll) {
            $scroll = Scroll::create([
                'page_id' => $page->id,
                'ip_id' => $ip->id,
                'max_scroll' => $request->get('maxScroll'),
            ]);
        }

        if ($scroll->max_scroll < $request->get('maxScroll')) {
            $scroll->max_scroll = $request->get('maxScroll');
            $scroll->save();
        }

        return response()->json([
            'message' => 'success',
        ]);
    }
}
