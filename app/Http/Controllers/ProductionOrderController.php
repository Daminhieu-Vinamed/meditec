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

    public function getProductionOrderV1(Request $request)
    {
        try {
            $data = $this->productionOrderService->getProductionOrderV1($request);
            return view('production-order-v1', $data);
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function getProductionOrderV2(Request $request)
    {
        try {
            $data = $this->productionOrderService->getProductionOrderV2($request);
            return view('production-order-v2', $data);
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function getAdditionalProductionOrder(Request $request)
    {
        try {
            $data = $this->productionOrderService->getProductionOrderV1($request);
            return view('additional-production-order', $data);
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function getProductCode()
    {
        return $this->productionOrderService->getProductCode();
    }

    public function updateProductionOrderV1(ProductionOrder1Request $request)
    {
        return $this->productionOrderService->updateProductionOrderV1($request);
    }

    public function updateProductionOrderV2(ProductionOrder2Request $request)
    {
        return $this->productionOrderService->updateProductionOrderV2($request);
    }

    public function semiFinishedProductCode(Request $request) {
        return $this->productionOrderService->semiFinishedProductCode($request->ProductCode);
    }
}