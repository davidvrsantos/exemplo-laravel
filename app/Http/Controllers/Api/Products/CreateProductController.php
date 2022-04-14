<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Http\Resources\Products\ProductResource;
use App\Services\Product\ProductsStorageService;

/**
 * Class CreateProductController
 */
class CreateProductController extends Controller
{
    /**
     * @param \App\Http\Requests\Products\ProductRequest $request
     * @param \App\Services\Product\ProductsStorageService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function __invoke(ProductRequest $request, ProductsStorageService $service): \Illuminate\Http\JsonResponse
    {
        $product = $service->setData($request->all())
            ->create();

        return response()->json([
            'message' => 'Produto criado com sucesso',
            'data' => new ProductResource($product),
        ]);
    }
}
