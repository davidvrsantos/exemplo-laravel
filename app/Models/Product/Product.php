<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Products
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property float $cost_price
 * @property int $quantity
 * @property int $quantity_min
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'cost_price',
        'quantity',
        'quantity_min',
    ];

    /**
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getForList($request): \Illuminate\Database\Eloquent\Builder
    {
        $query = static::query();

        $query->select("*");

        if ($request->query->has('search')) {
            $query->where('id', (int) $request->query('search'));
            $query->orWhere('name', 'iLike', "%{$request->query('search')}%");
            $query->orWhere('description', 'iLike', "%{$request->query('search')}%");
        }

        $query->orderBy($request->query('sort') ?? 'id');

        return $query;
    }
}
