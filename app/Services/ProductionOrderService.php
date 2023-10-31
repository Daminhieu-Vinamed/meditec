<?php
namespace App\Services;

use App\Repositories\ProductionOrderRepository;
use Illuminate\Support\Facades\DB;

class ProductionOrderService extends ProductionOrderRepository
{
    protected ProductionOrderRepository $productionOrderRepository;

    public function __construct(ProductionOrderRepository $productionOrderRepository)
    {
        $this->productionOrderRepository = $productionOrderRepository;
    }

    public function getProductionOrder($request)
    {
        if (session()->get('idScanQr') !== $request->id) {
            session(['idScanQr' => $request->id]);
        }
        $dataList = $this->productionOrderRepository->getProductionOrder($request->id);
        return $dataList;
    }

    public function getTime()
    {
        return $this->productionOrderRepository->getTime();
    }

    public function getProductCode()
    {
        return $this->productionOrderRepository->getProductCode();
    }

    public function updateProductionOrder($request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->ProductCode as $item => $productCode) {
                $quantitySx = $request->QuantitySX[$item];
                $chantCode = $request->ChantCode[$item];
                $workDay = $request->WorkDay[$item];
                $Id = isset($request->Id[$item]) ? $request->Id[$item] : config('constants.value.string-empty');
                $quantityFail = $request->QuantityFail[$item];
                $machineCode = $request->MachineCode[$item] === config('constants.value.null') ? config('constants.value.string-empty') : $request->MachineCode[$item];
                $itemLotCode = $request->ItemLotCode[$item];
                settype($Id, "integer");
                DB::update(
                    'EXEC usp_UpdateB20ProductionorderQuan_JobQuantityTT ?, ?, ?, ?, ?, ?, ?',
                    [
                        $Id,
                        $quantitySx,
                        $itemLotCode,
                        $productCode,
                        $workDay,
                        $chantCode,
                        session()->get('user')->Code
                    ]
                );
                DB::insert(
                    'EXEC usp_Create_B30JobRecord ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                    [
                        session()->get('user')->Code,
                        $quantitySx,
                        $itemLotCode,
                        $productCode,
                        $Id,
                        $chantCode,
                        $workDay,
                        $quantityFail,
                        $machineCode,
                        isset($request->DeptCodetmp[$item]) ? $request->DeptCodetmp[$item] : config('constants.value.null'),
                        isset($request->DocDate[$item]) ? $request->DocDate[$item] : config('constants.value.null')
                    ]
                );
            }
            DB::commit();
            return response()->json(['error_correct' => $request->DocDate === config('constants.value.null') ? __('messages.product_order.success') : __('messages.product_order.additional')]);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            $contains = str_contains($message, __('messages.product_order.wrong_time'));
            if ($contains) {
                return response()->json(['error_incorrect' => __('messages.product_order.too_regulated_time')]);
            } else {
                return response()->json(['error_incorrect' => $message]);
            }
        }
    }
}