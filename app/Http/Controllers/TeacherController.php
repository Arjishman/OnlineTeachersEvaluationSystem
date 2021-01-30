<?php

namespace App\Http\Controllers;

use App\Teacherinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tid = session('tid');
        $tinfo = DB::table('teacherinfos')
                    ->where('tid',$tid)->get();
        $regCourses = DB::table('courseinfos')->distinct('teacherinfo_id')
                    ->where('teacherinfo_id',$tid)->get();
        $activeys = DB::table('active_semesters')
                        ->where('dept',session('deptcode'))->get();
        return view('teacher.index')->with('tinfo',$tinfo[0])
                                        ->with('regcourses',$regCourses)->with('activeys',$activeys[0]);

    }

    public function authenticate(Request $request)
    {
        $tid = $request->get('tid');
        $pass = $request->get('password');
        $teacherInfo = Teacherinfo::where('tid',"$tid")->first();
        if(!empty($teacherInfo)){
            if($teacherInfo->tid == $tid && $teacherInfo->password == $pass){
                session()->put('tid',$teacherInfo->tid);
                session()->put('teacherloginstatus',1);
                session()->put('deptcode',$teacherInfo->deptcode);
                return redirect('/teacher');
            }else{
                return back()->with('error',"*Teacher id or password was incorrect");
            }
        }else{
            return back()->with('error',"*Teacher id or password was incorrect");
        }

    }

    //For Showing the Teacher's Login Form
    public function showLoginForm()
    {
        return view('teacher.login');
    }

    //For Logout Option
    public function logout()
    {
        session()->forget('teacherloginstatus');
        session()->forget('tid');
        session()->forget('deptcode');
        return redirect('teacher/login');
    }

}
