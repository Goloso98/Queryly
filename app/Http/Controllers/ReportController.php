<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Role;
use App\Models\Report;

class ReportController extends Controller
{
    //Delete Report
    public function delete(Request $request, $id)
    {   
        $report = Report::find($id);
        $this->authorize('delete', $report);
        $report->delete();
        $request->session()->flash('alert-success', 'This report has been successfully deleted!');
        return $report;
        
    }
}