<?php

namespace App\Repositories;

use App\Models\B20Dept;
use App\Models\B20HrmShift;
use App\Models\B20ItemWeb;
use App\Models\B20Machine;
use App\Models\B20Stage;
use App\Models\vB20Item_Web;
use App\Models\vB20ProductionorderQuanWeb;
use App\Repositories\AbstractRepository;

class ProductionOrderRepository extends AbstractRepository
{
    public function model()
    {
        return vB20ProductionorderQuanWeb::class;
    }

    public function getProductionOrder($ParentId)
    {
        $data = vB20ProductionorderQuanWeb::where('ParentId', $ParentId)->get();
        $arrayChantCode = B20HrmShift::orderBy('Code', 'ASC')->get();
        $arrayMachineCode = B20Machine::orderBy('Code', 'ASC')->get();
        $arrayStage = B20Stage::orderBy('Code', 'ASC')->get();
        $arrayChildStage = B20ItemWeb::where('ParentCode', $data[config('constants.number.zero')]->ProductCode)->get();
        $arrayDept = $arrayChildStage->isNotEmpty() ?  B20Dept::orderBy('Code', 'ASC')->get() : $arrayDept = config('constants.value.null');
        return array('data' => $data, 'arrayChantCode' => $arrayChantCode, 'arrayMachineCode' => $arrayMachineCode, 'arrayStage' => $arrayStage, 'arrayChildStage' => $arrayChildStage, 'arrayDept' => $arrayDept);
    }

    public function getTime()
    {
        $shiftAll = B20HrmShift::orderBy('Code', 'ASC')->get();
        $arrayShift = $shiftAll->map(function ($shift) {
            return collect($shift->toArray())
                ->only(['Code', 'Name', 'WorkDay'])
                ->all();
        });
        return response()->json(['shiftAll' => $arrayShift]);
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