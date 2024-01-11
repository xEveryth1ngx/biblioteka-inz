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
            ->where('created_at', '>=', $dateRange->toDateString())
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
            ['x_axis', 'y_axis', 'height', 'width']
        )
            ->where('created_at', '>=', $dateRange->toDateString())
            ->get()
            ->toArray();

        $maxHeight = 0;
        $maxWidth = 0;
        foreach ($clickCoordinates as $data) {
            $maxHeight = max($maxHeight, $data['height']);
            $maxWidth = max($maxWidth, $data['width']);
        }

        foreach ($clickCoordinates as $data) {
            $normalizedHeight = $maxHeight / $data['height'];
            $normalizedWidth = $maxWidth / $data['width'];

            $data['x_axis'] = $data['x_axis'] * $normalizedWidth;
            $data['y_axis'] = $data['y_axis'] * $normalizedHeight;
        }

        $gridSize = 10;
        $cellWidth = $maxWidth / $gridSize;
        $cellHeight = $maxHeight / $gridSize;

        $clickMap = array_fill(0, $gridSize, array_fill(0, $gridSize, 0));

        foreach ($clickCoordinates as $data) {
            $cellX = min((int)($data['x_axis'] / $cellWidth), $gridSize - 1);
            $cellY = min((int)($data['y_axis'] / $cellHeight), $gridSize - 1);

            $clickMap[$cellY][$cellX]++;
        }

        return response()->json([
            'clickMap' => $clickMap,
        ]);
    }
}
