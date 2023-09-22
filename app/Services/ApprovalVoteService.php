<?php
namespace App\Services;

use App\Repositories\ApprovalVoteRepository;

class ApprovalVoteService extends ApprovalVoteRepository{
    protected ApprovalVoteRepository $approvalVoteRepository;

    public function __construct(ApprovalVoteRepository $approvalVoteRepository)
    {
        $this->approvalVoteRepository = $approvalVoteRepository;
    }

    public function getApprovalVote()
    {
        return $this->approvalVoteRepository->getApprovalVote();
    }
}