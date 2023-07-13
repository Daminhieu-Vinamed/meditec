<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validate;
use App\Models\B20HrmShift;
use App\Models\B20Machine;
use App\Models\vB20Item_Web;
use App\Models\vB20ProductionorderQuanWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class vB20ProductionorderQuanWebController extends Controller
{
    public function getListEdit(Request $request)
    {
        $data = vB20ProductionorderQuanWeb::where('ParentId', $request->id)->get();
        $arrayChantCode = B20HrmShift::orderBy('Code', 'ASC')->get();
        $arrayMachineCode = B20Machine::orderBy('Code', 'ASC')->get();
        return view('table-edit',['data' => $data, 'arrayChantCode' => $arrayChantCode, 'arrayMachineCode' => $arrayMachineCode]);
    }

    public function getTime (Request $request){
        $shift = B20HrmShift::where('Code', $request->code)->first();
        return response()->json(['hour' => $shift->WorkDay, 'idSelect' => $request->idSelect]);
    }

    // public function getChantCode (){
    //     $dataChantCode = B20HrmShift::orderBy('Code', 'ASC')->get();
    //     $arrayChantCode = $dataChantCode->map(function ($chantCode) {
    //         return collect($chantCode->toArray())
    //             ->only(['Code', 'Name', 'IsGroup', 'IsActive'])
    //             ->all();
    //     });
    //     return response()->json(['arrayChantCode' => $arrayChantCode]);
    // }

    public function getProductCode (){
        $dataProductCode = vB20Item_Web::orderBy('ProductCode', 'ASC')->get();
        $arrayProductCode = $dataProductCode->map(function ($productCode) {
            return collect($productCode->toArray())
                ->only(['ProductCode', 'Name'])
                ->all();
        });
        return response()->json(['arrayProductCode' => $arrayProductCode]);
    }

    public function update(Validate $request)
    {
        if (isset($request->type) && $request->type === 'update') {
            try {
                foreach ($request->Id as $item => $id) {
                    $quantitySx = $request->QuantitySX[$item];
                    $itemLotCode = $request->ItemLotCode[$item];
                    $productCode = $request->ProductCode[$item];
                    $chantCode = $request->ChantCode[$item];
                    $workDay = $request->WorkDay[$item];
                    $quantityFail = $request->QuantityFail[$item];
                    $machineCode = $request->MachineCode[$item];
                    settype($id, "integer");
                    DB::update('EXEC usp_UpdateB20ProductionorderQuan_JobQuantityTT ?, ?, ?, ?, ?, ?, ?', [$id, $quantitySx, $itemLotCode, $productCode, $workDay, $chantCode, session()->get('user')->Code]);
                    DB::insert('EXEC usp_Create_B30JobRecord ?, ?, ?, ?, ?, ?, ?, ?, ?', [session()->get('user')->Code, $quantitySx, $itemLotCode, $productCode, $id, $chantCode, $workDay, $quantityFail, $machineCode]);
                }
                return response()->json(['error_correct' => 'Cập nhật thành công !']);
            } catch (\Exception $e) {
                $message = $e->getMessage();
                $contains = str_contains($message, 'Sai giờ làm việc');
                if ($contains) {
                    return response()->json(['error_incorrect' => 'Thời gian làm việc không được vượt quá quy định !']);
                }else{
                    return response()->json(['error_incorrect' => 'Lỗi hệ thống !']);
                }
            }
        }elseif(isset($request->type) && $request->type === 'edit'){
            return response()->json(['error_incorrect' => 'Chức năng chỉnh sửa hiện tại đang trong quá trình phát triển !']);
        }
    }
    
    public function notification()
    {
        return view('notification');
    }
}
