<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validate;
use App\Services\ProductionOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductionOrderController extends Controller
{
    protected ProductionOrderService $productionOrderService;

    public function __construct(ProductionOrderService $productionOrderService)
    {
        $this->productionOrderService = $productionOrderService;
    }

    public function getListEdit(Request $request)
    {
        $data = $this->productionOrderService->getListEdit($request);
        return view('production-order', $data);
    }

    public function getTime(){
        return $this->productionOrderService->getTime();
    }

    public function getProductCode(){
        return $this->productionOrderService->getProductCode();
    }

    public function update(Validate $request)
    {
        return $this->productionOrderService->updateProductionOrder($request);
    }
    
    public function notification()
    {
        return view('notification');
    }
}
