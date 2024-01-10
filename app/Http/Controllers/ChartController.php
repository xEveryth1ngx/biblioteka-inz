<?php

namespace App\Http\Controllers;

use App\Enum\RangeEnum;
use App\Models\Click;
use App\Models\SiteEntrance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ChartController extends Controller
{
    public function index(Request $request): View
    {
        return view('results.results');
    }

    public function getEntrances(Request $request, int $range)
    {
        $dateRange = match ($range) {
            RangeEnum::WEEK->value => now()->subDays(7),
            RangeEnum::MONTH->value => now()->subDays(30),
            RangeEnum::ALL->value => now()->subDays(365),
            default => now()->subDays(),
        };

        $entrancesPerDay = SiteEntrance::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count'),
        )
            ->where('created_at', '>=', $dateRange->toDateString())
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        return response()->json([
            'entrancesPerDay' => $entrancesPerDay,
        ]);
    }

    public function getClicks(Request $request, int $range)
    {
        $dateRange = match ($range) {
            RangeEnum::WEEK->value => now()->subDays(7),
            RangeEnum::MONTH->value => now()->subDays(30),
            RangeEnum::ALL->value => now()->subDays(365),
            default => now()->subDays(),
        };

        $clicksPerDay = Click::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', $dateRange->toDateString())
            ->groupBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        return response()->json([
            'clicksPerDay' => $clicksPerDay,
        ]);
    }

    public function getMostClicked(Request $request, int $range)
    {
        $dateRange = match ($range) {
            RangeEnum::WEEK->value => now()->subDays(7),
            RangeEnum::MONTH->value => now()->subDays(30),
            RangeEnum::ALL->value => now()->subDays(365),
            default => now()->subDays(),
        };

        $mostClicked = Click::groupBy(
            ['element_type', 'element_id', 'element_classes']
        )
            ->select(['element_type', 'element_id', 'element_classes', DB::raw('count(*) as total')])
            ->where('created_at', '>', $dateRange->toDateString())
            ->orderByDesc('total')
            ->get()
            ->take(5)
            ->toArray();

        return response()->json([
            'mostClicked' => $mostClicked,
        ]);
    }

    public function getClickMap(Request $request, int $range)
    {
        $dateRange = match ($range) {
            RangeEnum::WEEK->value => now()->subDays(7),
            RangeEnum::MONTH->value => now()->subDays(30),
            RangeEnum::ALL->value => now()->subDays(365),
            default => now()->subDays(),
        };

        $clickCoordinates = Click::select(
            ['x', 'y', 'height', 'width']
        )
            ->get()
            ->toArray();

        $maxHeight = 0;
        $maxWidth = 0;
        foreach ($clickCoordinates as $data) {
            $data['height'] > $maxHeight ? $maxHeight = $data['height'] : null;
            $data['width'] > $maxWidth ? $maxWidth = $data['width'] : null;
        }

        foreach ($clickCoordinates as &$data) {
            $normalizedHeight = $maxHeight / $data['height'];
            $normalizedWidth = $maxWidth / $data['width'];

            $data['x'] = $data['x'] * $normalizedWidth;
            $data['y'] = $data['y'] * $normalizedHeight;
        }


        return response()->json([
            'clickMap' => $clickMap,
        ]);
    }
}
