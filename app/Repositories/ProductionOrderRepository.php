<?php

namespace App\Repositories;

use App\Models\B20Dept;
use App\Models\B20HrmShift;
use App\Models\B20ItemWeb;
use App\Models\B20Machine;
use App\Models\B20Stage;
use App\Models\User;
use App\Models\vB20Item_Web;
use App\Models\vB20ProductionorderQuanWeb;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Facades\DB;

class ProductionOrderRepository extends AbstractRepository
{
    public function model()
    {
        return vB20ProductionorderQuanWeb::class;
    }

    public function getProductionOrder1($ParentId)
    {
        $data = vB20ProductionorderQuanWeb::where('ParentId', $ParentId)->get();
        $arrayChantCode = B20HrmShift::orderBy('Code', 'ASC')->get();
        $arrayMachineCode = B20Machine::orderBy('Code', 'ASC')->get();
        $arrayStage = B20Stage::orderBy('Code', 'ASC')->get();
        $arrayChildStage = B20ItemWeb::where('ParentCode', $data[config('constants.number.zero')]->ProductCode)->get();
        $arrayDept = B20Dept::orderBy('Code', 'ASC')->get();
        return array(
            'data' => $data, 
            'arrayChantCode' => $arrayChantCode, 
            'arrayMachineCode' => $arrayMachineCode, 
            'arrayStage' => $arrayStage, 
            'arrayChildStage' => $arrayChildStage, 
            'arrayDept' => $arrayDept,
            'id' => $ParentId
        );
    }
    
    public function getProductionOrder2($ParentId)
    {
        $data = vB20ProductionorderQuanWeb::select(
            'vB20ProductionorderQuan_Web.ItemLotCode', 
            'vB20ProductionorderQuan_Web.ProductCode', 
            'vB20ProductionorderQuan_Web.Id', 
            'vB20ProductionorderQuan_Web.ProductName', 
            'vB20ProductionorderQuan_Web.JobQuantity', 
            'vB20ProductionorderQuan_Web.JobQuantityTT', 
            'vB20ProductionorderQuan_Web.QuantityCL', 
            'vB20ProductionorderQuan_Web.DocNo',
            'vB20HrmProductUnitCost_Web.CapacityOne'
        )->join('vB20HrmProductUnitCost_Web', 'vB20HrmProductUnitCost_Web.ProductCode', '=', 'vB20ProductionorderQuan_Web.ProductCode')
        ->where('vB20ProductionorderQuan_Web.ParentId', $ParentId)->get();
        $arrayChantCode = B20HrmShift::orderBy('Code', 'ASC')->get();
        $arrayMachineCode = B20Machine::orderBy('Code', 'ASC')->get();
        $arrayStage = B20Stage::orderBy('Code', 'ASC')->get();
        $arrayChildStage = B20ItemWeb::where('ParentCode', $data[config('constants.number.zero')]->ProductCode)->get();
        $arrayDept = B20Dept::orderBy('Code', 'ASC')->get();
        $arrayEmployee = User::where('IsActive', config('constants.number.one'))->where('IsGroup', config('constants.number.zero'))->select('Code', 'Name')->get();
        return array(
            'data' => $data, 
            'arrayChantCode' => $arrayChantCode, 
            'arrayMachineCode' => $arrayMachineCode, 
            'arrayStage' => $arrayStage, 
            'arrayChildStage' => $arrayChildStage, 
            'arrayDept' => $arrayDept, 
            'id' => $ParentId,
            'arrayEmployee' => $arrayEmployee
        );
    }

    public function getProductCode()
    {
        $dataProductCode = vB20Item_Web::orderBy('ProductCode', 'ASC')->get();
        $arrayProductCode = $dataProductCode->map(function ($productCode) {
            return collect($productCode->toArray())
                ->only(['ProductCode', 'Name'])
                ->all();
        });
        return response()->json(['arrayProductCode' => $arrayProductCode]);
    }
}