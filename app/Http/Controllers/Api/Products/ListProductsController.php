<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductListResource;
use App\Models\Product\Product;
use Illuminate\Http\Request;

/**
 * Class ListProductsController
 */
class ListProductsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $limit = $request->query('limit') ?? 15;

        $list = Product::getForList($request)
            ->paginate($limit);

        return ProductListResource::collection($list);
    }
}
