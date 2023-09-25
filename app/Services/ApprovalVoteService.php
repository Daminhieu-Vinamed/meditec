<?php
namespace App\Services;

use App\Repositories\ApprovalVoteRepository;
use Illuminate\Support\Facades\DB;

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

    public function updateStatusApprovalVote($request) {
        DB::beginTransaction();
        try{
            DB::update('EXEC usp_Update_B30JobRecord ?', [$request->parentId]);
            DB::commit();
            return response()->json(['error_correct' => 'Duyệt phiếu thành công !']);
        }catch(\Exception $e){
            DB::rollBack();
            $message = $e->getMessage();
            return response()->json(['error_incorrect' => $message]);
        }
    }
}