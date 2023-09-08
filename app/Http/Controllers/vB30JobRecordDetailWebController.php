<?php

namespace App\Http\Controllers;

use App\Models\vB30JobRecordDetailWeb;
use Illuminate\Http\Request;

class vB30JobRecordDetailWebController extends Controller
{
    public function getApprovalVoteDetail($id) {
        $detailApprovalVote = vB30JobRecordDetailWeb::where('ParentId', $id)->paginate(7);
        return view('table-approval-vote-detail', compact('detailApprovalVote'));
    }
}
