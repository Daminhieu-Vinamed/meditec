<?php
namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Models\vB30JobRecord_ExploeruWeb;
use Illuminate\Support\Facades\DB;

class ApprovalVoteRepository extends AbstractRepository 
{
    public function model()
    {
        return vB30JobRecord_ExploeruWeb::class;
    }

    public function getApprovalVote() {
        return vB30JobRecord_ExploeruWeb::orderBy('DocDate', 'desc')->paginate(6);
    }
}