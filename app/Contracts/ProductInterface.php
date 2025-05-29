<?php

namespace App\Contracts;

use App\DTOs\Products\StoreDTO;
use App\DTOs\Products\UpdateDTO;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductInterface
{
    /**
     * @param StoreDTO $data
     * @return Product
     */
    public function store(StoreDTO $data): Product;

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function index(int $perPage = 10): LengthAwarePaginator;

    /**
     * @param int $id
     * @return Product
     */
    public function show(int $id): Product;

    /**
     * @param int $id
     * @param UpdateDTO $data
     * @return Product
     */
    public function update(int $id, UpdateDTO $data): Product;

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool;
}
