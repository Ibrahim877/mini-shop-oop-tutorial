<?php

namespace App\Services;

use App\Contracts\ProductInterface;
use App\DTOs\Product\StoreDTO;
use App\DTOs\Product\UpdateDTO;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService implements ProductInterface
{
    /**
     * @param StoreDTO $data
     * @return Product
     */
    public function store(StoreDTO $data): Product
    {
        $product = new Product();
        $product->name = $data->name;
        $product->slug = $data->slug;
        $product->description = $data->description;
        $product->price = $data->price;
        $product->stock = $data->stock;
        $product->save();
        return $product;
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function index(int $perPage = 10): LengthAwarePaginator
    {
        return Product::latest()->paginate($perPage);
    }

    /**
     * @param int $id
     * @return Product
     */
    public function show(int $id): Product
    {
        return Product::find($id);
    }

    /**
     * @param int $id
     * @param UpdateDTO $data
     * @return Product
     */
    public function update(int $id, UpdateDTO $data): Product
    {
        $product = Product::find($id);
        $product->name = $data->name;
        $product->slug = $data->slug;
        $product->description = $data->description;
        $product->price = $data->price;
        $product->stock = $data->stock;
        $product->save();
        return $product;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $product = Product::first($id);
        return $product->delete();
    }
}
