<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductionOrderRequest;
use App\Services\ProductionOrderService;
use Illuminate\Http\Request;

class ProductionOrderController extends Controller
{
    protected ProductionOrderService $productionOrderService;

    public function __construct(ProductionOrderService $productionOrderService)
    {
        $this->productionOrderService = $productionOrderService;
    }

    public function getProductionOrder(Request $request)
    {
        try {
            $data = $this->productionOrderService->getProductionOrder($request);
            return view('production-order', $data);
        } catch (\Exception $e) {
            return view('notification');
        }
    }

    public function getAdditionalProductionOrder(Request $request)
    {
        try {
            $data = $this->productionOrderService->getProductionOrder($request);
            return view('additional-production-order', $data);
        } catch (\Exception $e) {
            return view('notification');
        }
    }

    public function getTime()
    {
        return $this->productionOrderService->getTime();
    }

    public function getProductCode()
    {
        return $this->productionOrderService->getProductCode();
    }

    public function updateProductionOrder(ProductionOrderRequest $request)
    {
        return $this->productionOrderService->updateProductionOrder($request);
    }

    public function notification()
    {
        return view('notification');
    }
}