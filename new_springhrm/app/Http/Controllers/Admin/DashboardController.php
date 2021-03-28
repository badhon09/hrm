<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index(){





        $totalemp = User::get();

        $activeuser = Attendance::join('users','users.id','=','attendances.user_id')
        ->where('attendances.timeout','0')->get();

        $check = count($totalemp) - count($activeuser);
        
        return view('admin.dashboard',compact('activeuser','check'));
    }
}
