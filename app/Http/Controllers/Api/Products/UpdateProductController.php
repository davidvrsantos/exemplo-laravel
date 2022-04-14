<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Models\Product\Product;
use App\Services\Product\ProductsStorageService;

/**
 * Class UpdateProductController
 */
class UpdateProductController extends Controller
{
    /**
     * @param \App\Http\Requests\Products\ProductRequest $request
     * @param \App\Services\Product\ProductsStorageService $storageService
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function __invoke(ProductRequest $request, ProductsStorageService $storageService, int $id): \Illuminate\Http\JsonResponse
    {
        $model = Product::query()->findOrFail($id);

        $product = $storageService->setDataForUpdate($request->all())
            ->setModel($model)
            ->replace();

        return response()->json([
            'message' => 'Cadastro atualizado com sucesso',
            'product' => $product,
        ]);
    }
}
