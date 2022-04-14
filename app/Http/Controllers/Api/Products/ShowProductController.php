<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\Http\Request;

/**
 * Class ShowProductController
 */
class ShowProductController extends Controller
{
    public function __invoke(Request $request, int $id): \App\Http\Resources\Products\ProductResource
    {
        $product = Product::query()->findOrfail($id);

        return new \App\Http\Resources\Products\ProductResource($product);
    }
}
