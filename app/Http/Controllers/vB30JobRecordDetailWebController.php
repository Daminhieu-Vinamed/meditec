<?php

namespace App\Http\Controllers;

use App\Models\B20HrmShift;
use App\Models\B20Machine;
use App\Models\vB30JobRecordDetailWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class vB30JobRecordDetailWebController extends Controller
{
    public function getApprovalVoteDetail(Request $request) {
        $grandparentId = $request->grandparentId;
        $parentId = $request->parentId;
        $arrayChantCode = B20HrmShift::orderBy('Code', 'ASC')->get();
        $arrayMachineCode = B20Machine::orderBy('Code', 'ASC')->get();
        $detailApprovalVote = vB30JobRecordDetailWeb::where('ParentId',$parentId)->get();
        return view('approval-vote-detail', compact('detailApprovalVote', 'parentId', 'grandparentId', 'arrayMachineCode', 'arrayChantCode'));
    }

    public function updateStatusApprovalVoteDetail(Request $request) {
        $ParentId = $request->parentId;
        settype($ParentId, "integer");
        try{
            foreach ($request->Id as $item => $Id) {
                settype($Id, "integer");
                DB::update('EXEC usp_Update_B30JobRecordDetailFromWeb ?, ?, ?, ?, ?, ?', [$ParentId, $Id, $request->MachineCode[$item], $request->ChantCode[$item], $request->TimeExcute[$item], $request->Quantity9[$item]]);
            }
            return response()->json(['error_correct' => 'Duyệt phiếu thành công !']);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json(['error_incorrect' => $message]);
        }
    }
}
