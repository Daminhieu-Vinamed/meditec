<?php

namespace App\Http\Controllers;

use App\Models\vB30JobRecordDetailWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class vB30JobRecordDetailWebController extends Controller
{
    public function getApprovalVoteDetail(Request $request, $parentId) {
        $grandparentId = $request->grandparentId;
        $detailApprovalVote = vB30JobRecordDetailWeb::where('ParentId', $parentId)->paginate(7);
        return view('table-approval-vote-detail', compact('detailApprovalVote', 'parentId', 'grandparentId'));
    }

    public function updateStatusApprovalVoteDetail(Request $request) {
        try{
            DB::update('EXEC usp_Update_B30JobRecord ?', [$request->parentId]);
            return response()->json(['error_correct' => 'Cập nhật thành công !']);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json(['error_incorrect' => $message]);
        }
    }
}
