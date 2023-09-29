<?php

namespace App\Http\Controllers;

use App\Services\ApprovalVoteService;
use Illuminate\Http\Request;

class ApprovalVoteController extends Controller
{
    protected ApprovalVoteService $approvalVoteService;

    public function __construct(ApprovalVoteService $approvalVoteService)
    {
        $this->approvalVoteService = $approvalVoteService;
    }

    public function getViewApprovalVote() {
        return view('approval-vote');
    }
    public function getDataApprovalVote() {
        return $this->approvalVoteService->getDataApprovalVote();
    }

    public function updateStatusApprovalVote(Request $request) {
        return $this->approvalVoteService->updateStatusApprovalVote($request);
    }
}
