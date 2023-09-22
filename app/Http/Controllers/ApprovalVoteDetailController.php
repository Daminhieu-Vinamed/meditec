<?php

namespace App\Http\Controllers;

use App\Models\B20HrmShift;
use App\Models\B20Machine;
use App\Models\vB30JobRecordDetailWeb;
use App\Services\ApprovalVoteDetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalVoteDetailController extends Controller
{
    protected ApprovalVoteDetailService $approvalVoteDetailService;

    public function __construct(ApprovalVoteDetailService $approvalVoteDetailService) 
    {
        $this->approvalVoteDetailService = $approvalVoteDetailService;
    }

    public function getApprovalVoteDetail(Request $request) 
    {
        $data = $this->approvalVoteDetailService->getApprovalVoteDetail($request);
        return view('approval-vote-detail', $data);
    }

    public function updateStatusApprovalVoteDetail(Request $request) {
        return $this->approvalVoteDetailService->updateStatusApprovalVoteDetail($request);
    }
}
