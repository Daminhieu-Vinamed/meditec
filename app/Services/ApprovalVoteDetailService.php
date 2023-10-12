<?php
namespace App\Services;

use App\Repositories\ApprovalVoteDetailRepository;
use Illuminate\Support\Facades\DB;

class ApprovalVoteDetailService extends ApprovalVoteDetailRepository
{
    protected ApprovalVoteDetailRepository $approvalVoteDetailRepository;

    public function __construct(ApprovalVoteDetailRepository $approvalVoteDetailRepository)
    {
        $this->approvalVoteDetailRepository = $approvalVoteDetailRepository;
    }

    public function getApprovalVoteDetail($request)
    {
        $data = $this->approvalVoteDetailRepository->getApprovalVoteDetail($request->id);
        $data['parentId'] = $request->id;
        return $data;
    }

    public function updateStatusApprovalVoteDetail($request) 
    {
        $ParentId = $request->parentId;
        settype($ParentId, "integer");
        DB::beginTransaction();
        try{
            foreach ($request->Id as $item => $Id) {
                settype($Id, "integer");
                DB::update('EXEC usp_Update_B30JobRecordDetailFromWeb ?, ?, ?, ?, ?, ?', [$ParentId, $Id, $request->MachineCode[$item], $request->ChantCode[$item], $request->TimeExcute[$item], $request->Quantity9[$item]]);
            }
            DB::commit();
            return response()->json(['error_correct' => __('messages.approval_vote.success')]);
        }catch(\Exception $e){
            DB::rollBack();
            $message = $e->getMessage();
            return response()->json(['error_incorrect' => $message]);
        }
    }
}