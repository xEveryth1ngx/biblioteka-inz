<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\Page;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Http\Request;

class ClickController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        $data = $request->all();
        $page = Page::firstOrCreate([
            'url' => $data['page'],
        ]);

        Click::create([
            'element_type' => $data['elementType'],
            'element_id' => $data['elementId'],
            'element_classes' => json_encode($data['elementClasses']),
            'page' => $page->id,
            'y_axis' => $data['y'],
            'x_axis' => $data['x'],
            'width' => $data['width'],
            'height' => $data['height'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Click $click)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Click $click)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Click $click)
    {
        //
    }
}
