<?php

namespace App\Http\Controllers;

use App\Models\vB30JobRecord_ExploeruWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class vB30JobRecord_ExploeruWebController extends Controller
{
    public function getApprovalVote($parentId) {
        $allApprovalVote = vB30JobRecord_ExploeruWeb::orderBy('DocDate', 'desc')->paginate(7);
        return view('table-approval-vote', compact('allApprovalVote', 'parentId'));
    }

    public function updateStatusApprovalVote(Request $request) {
        try{
            DB::update('EXEC usp_Update_B30JobRecord ?', [$request->parentId]);
            return response()->json(['error_correct' => 'Duyệt phiếu thành công !']);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json(['error_incorrect' => $message]);
        }
    }
}
