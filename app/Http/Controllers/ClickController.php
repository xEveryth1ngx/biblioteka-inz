<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\Page;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClickController extends Controller
{
   public function __invoke(Request $request): JsonResponse
   {
       $data = $request->all();
       $page = Page::firstOrCreate([
           'url' => $data['page'],
       ]);

       Click::create([
           'element_type' => $data['elementType'],
           'element_id' => $data['elementId'],
           'element_classes' => json_encode($data['elementClasses']),
           'page_id' => $page->id,
           'y_axis' => $data['y'],
           'x_axis' => $data['x'],
           'width' => $data['width'],
           'height' => $data['height'],
       ]);

       return response()->json([
           'message' => 'success',
       ]);
   }
}
