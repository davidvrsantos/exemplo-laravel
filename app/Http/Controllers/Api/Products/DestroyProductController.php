<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductsStorageService;
use Illuminate\Http\Request;

/**
 * Class DestroyProductController
 */
class DestroyProductController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Services\Product\ProductsStorageService $service
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function __invoke(Request $request, ProductsStorageService $service, int $id): \Illuminate\Http\JsonResponse
    {
        $product = $service->destroy($id);

        if ($product) {
            return response()->json([
                'message' => 'Produto apagado com sucesso',
            ]);
        }

        return response()->json([
            'message' => 'Ocorreu um erro ao apagar o produto',
        ], 400);
    }
}
