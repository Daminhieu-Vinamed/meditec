<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductionOrder1Request;
use App\Http\Requests\ProductionOrder2Request;
use App\Services\ProductionOrderService;
use Illuminate\Http\Request;

class ProductionOrderController extends Controller
{
    protected ProductionOrderService $productionOrderService;

    public function __construct(ProductionOrderService $productionOrderService)
    {
        $this->productionOrderService = $productionOrderService;
    }

    public function getProductionOrder1(Request $request)
    {
        try {
            $data = $this->productionOrderService->getProductionOrder1($request);
            return view('production-order-1', $data);
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function getProductionOrder2(Request $request)
    {
        try {
            $data = $this->productionOrderService->getProductionOrder2($request);
            return view('production-order-2', $data);
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function getAdditionalProductionOrder(Request $request)
    {
        try {
            $data = $this->productionOrderService->getProductionOrder1($request);
            return view('additional-production-order', $data);
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function getProductCode()
    {
        return $this->productionOrderService->getProductCode();
    }

    public function updateProductionOrder1(ProductionOrder1Request $request)
    {
        return $this->productionOrderService->updateProductionOrder1($request);
    }

    public function updateProductionOrder2(ProductionOrder2Request $request)
    {
        return $this->productionOrderService->updateProductionOrder2($request);
    }
}