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
        $data = $this->approvalVoteDetailRepository->getApprovalVoteDetail($request->parentId);
        $data['grandparentId'] = $request->grandparentId;
        $data['parentId'] = $request->parentId;
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
            return response()->json(['error_correct' => 'Duyệt phiếu thành công !']);
        }catch(\Exception $e){
            DB::rollBack();
            $message = $e->getMessage();
            return response()->json(['error_incorrect' => $message]);
        }
    }
}