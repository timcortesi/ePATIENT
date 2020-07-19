<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Team;
use App\TeamMember;
use App\TeamMessage;
use App\TeamNote;
use App\TeamScenario;
use App\TeamActivityLog;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function __construct() {
    }

    public function list(Request $request) {
        if ($request->has('accountId')) {
            $user = User::where('unique_id','like','_demo%')
                ->where('unique_id',$request->accountId)
                ->first();
            if (!is_null($user)) {
                Auth::login($user,true);
                return redirect('/');
            } else {
                return view('auth.demo_login',['error'=>'The '.$request->accountId.' guest user account is not authorized']);
            }
        } else {
            return view('auth.demo_login');
        }
    }
}