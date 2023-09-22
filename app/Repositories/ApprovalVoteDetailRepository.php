<?php
namespace App\Repositories;

use App\Models\B20HrmShift;
use App\Models\B20Machine;
use App\Models\vB30JobRecordDetailWeb;
use App\Repositories\AbstractRepository;

class ApprovalVoteDetailRepository extends AbstractRepository 
{
    public function model()
    {
        return vB30JobRecordDetailWeb::class;
    }

    public function getApprovalVoteDetail($parentId) {
        $arrayChantCode = B20HrmShift::orderBy('Code', 'ASC')->get();
        $arrayMachineCode = B20Machine::orderBy('Code', 'ASC')->get();
        $detailApprovalVote = vB30JobRecordDetailWeb::where('ParentId',$parentId)->get();
        return array('arrayChantCode' => $arrayChantCode, 'arrayMachineCode' => $arrayMachineCode, 'detailApprovalVote' => $detailApprovalVote);
    }
}