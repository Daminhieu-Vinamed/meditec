<?php
namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Models\vB30JobRecord_ExploeruWeb;
use Yajra\DataTables\Facades\DataTables;

class ApprovalVoteRepository extends AbstractRepository 
{
    public function model()
    {
        return vB30JobRecord_ExploeruWeb::class;
    }

    public function getDataApprovalVote() {
        $data = $this->builder()->orderBy('DocDate', 'desc')->get();
        return DataTables::of($data)
        ->editColumn('DocDate', function($approvalVote){
            return date("d-m-Y", strtotime($approvalVote['DocDate']));
        })
        ->editColumn('DocNo', function($approvalVote){
            return '<a href="'.route('list.detail-approval-vote', ['id' => $approvalVote['Id']]).'">'.$approvalVote['DocNo'].'</a>';
        })
        ->addColumn('action', function($approvalVote){
           return '<button type="button" class="btn btn-info update-status-approval-vote" id="'. $approvalVote['Id'].'">DUYỆT PHIẾU</button>';
        })
        ->rawColumns(['DocNo', 'action'])
        ->make(true);
    }
}