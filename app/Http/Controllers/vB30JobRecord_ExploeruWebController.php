<?php

namespace App\Http\Controllers;

use App\Models\vB30JobRecord_ExploeruWeb;
use Illuminate\Http\Request;

class vB30JobRecord_ExploeruWebController extends Controller
{
    public function getApprovalVote() {
        $allApprovalVote = vB30JobRecord_ExploeruWeb::orderBy('DocDate', 'desc')->paginate(7);
        return view('table-approval-vote', compact('allApprovalVote'));
    }
}
