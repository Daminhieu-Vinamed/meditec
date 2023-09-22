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