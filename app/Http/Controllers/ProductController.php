<?php

namespace App\Http\Controllers;

use App\Contracts\ProductInterface;
use App\DTOs\Product\StoreDTO;
use App\DTOs\Product\UpdateDTO;
use App\Http\Requests\Products\GetRequest;
use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductInterface $service
    )
    {
        parent::__construct();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $dto = StoreDTO::fromArray($request->validated());
            $product = $this->service->store($dto);
            $this->success('Məhsul əlavə edildi');
            $this->res->product = $product;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = $this->service->index();
        return response()->json([
            'products' => $products,
        ]);
    }

    public function show(GetRequest $request): JsonResponse
    {
        $product = $this->service->show($request->id);
        return response()->json([
            'product' => $product,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        try {
            $dto = UpdateDTO::fromArray($request->validated());
            $product = $this->service->update($request->id, $dto);
            $this->success('Məhsul update edildi');
            $this->res->product = $product;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @param GetRequest $request
     * @return JsonResponse
     */
    public function destroy(GetRequest $request): JsonResponse
    {
        try {
            $result = $this->service->destroy($request->id);
            $this->success('Məhsul silindi');;
            $this->res->result = $result;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return $this->response();
    }
}
