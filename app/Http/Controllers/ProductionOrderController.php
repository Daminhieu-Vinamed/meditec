<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validate;
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
        $data = $this->productionOrderService->getProductionOrder($request);
        return view('production-order', $data);
    }

    public function getAddProductionOrderInformation(Request $request)
    {
        $data = $this->productionOrderService->getProductionOrder($request);
        return view('additional-production-order', $data);
    }

    public function getTime(){
        return $this->productionOrderService->getTime();
    }

    public function getProductCode(){
        return $this->productionOrderService->getProductCode();
    }

    public function updateProductionOrder(Validate $request)
    {
        return $this->productionOrderService->updateProductionOrder($request);
    }
    
    public function notification()
    {
        return view('notification');
    }
}
