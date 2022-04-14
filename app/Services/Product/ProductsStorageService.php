<?php

namespace App\Services\Product;

use App\Models\Product\Product;
use App\Services\Contracts\DatabaseStorageService;

/**
 * Class ProductsStorageService
 *
 * @property \App\Models\Product\Product $model
 */
class ProductsStorageService extends DatabaseStorageService
{
    /**
     *
     */
    public function __construct()
    {
        $this->model = new Product();
    }

    /**
     * @param string $mode
     * @return void
     */
    protected function prepareDataForStorage(string $mode): void
    {
        $this->data['name'] = (string)$this->data['name'];
        $this->data['description'] = $this->data['description'] ?? '';
        $this->data['price'] = $this->data['price'] ?? 0.00;
        $this->data['cost_price'] = $this->data['price'] ?? 0.00;
        $this->data['quantity'] = $this->data['quantity'] ?? 0;
        $this->data['quantity_min'] = $this->data['quantity_min'] ?? 0;
    }

    /**
     * @param array $data
     *
     * @return \App\Models\Product\Product
     */
    private function createModel(array $data)
    {
        return $this->getQuery()->create($data)->refresh();
    }

    /**
     * @return \App\Models\Product\Product
     * @throws \Throwable
     */
    public function create(): Product
    {
        return $this->transaction(function () {
            // se necessário tratar algo como, verificar duplicidade de nome e etc...

            $this->model = $this->createModel($this->data);

            return $this->model;
        });
    }

    /**
     * @return \App\Models\Product\Product
     * @throws \Throwable
     */
    public function replace(): Product
    {
        return $this->transaction(function () {
            // se necessário tratar algo como, verificar duplicidade de nome e etc...

            $this->model->fill($this->data);
            $this->model->save();

            return $this->model;
        });
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Throwable
     */
    public function destroy(int $id): bool
    {
        return $this->transaction(function () use ($id) {
            // mesma situação se precisar verificar algo antes de fazer a exlusão
            return $this->model->newQuery()->findOrFail($id)->delete();
        });
    }
}
