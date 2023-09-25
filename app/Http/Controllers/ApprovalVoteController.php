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

    public function getApprovalVote($parentId) {
        $allApprovalVote = $this->approvalVoteService->getApprovalVote();
        return view('approval-vote', compact('allApprovalVote', 'parentId'));
    }

    public function updateStatusApprovalVote(Request $request) {
        return $this->approvalVoteService->updateStatusApprovalVote($request);
    }
}
