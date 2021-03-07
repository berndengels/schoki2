<?php

namespace App\Http\Controllers\Api\SPA;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpaProductResource;

class SpaProductController extends Controller
{

    public function __construct()
    {
        SpaProductResource::withoutWrapping();
    }

    public function products()
    {
        $result = Product::whereIsPublished(1)->get();
        $result = SpaProductResource::collection($result);
        return response()->json($result);
    }

    public function product($id)
    {
        $result = Product::find($id);
        $result = new SpaProductResource($result);
        return response()->json($result);
    }
}
