<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprovalVoteDetailRequest;
use App\Services\ApprovalVoteDetailService;
use Illuminate\Http\Request;

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

    public function updateStatusApprovalVoteDetail(ApprovalVoteDetailRequest $request) {
        return $this->approvalVoteDetailService->updateStatusApprovalVoteDetail($request);
    }
}
