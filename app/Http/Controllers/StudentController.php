<?php

namespace App\Http\Controllers;

use App\Admininfo;
use App\Evaluatemcq;
use App\Questionmcq;
use App\Questionopenended;
use App\Studentinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = session('studentid');
        $student = DB::table('studentinfos')->where('sid',$id)->get();

        $regCourses = DB::table('studentcourseregistrations')
                        ->join('courseinfos','studentcourseregistrations.courseid','=','courseinfos.courseid')
                        ->join('teacherinfos','courseinfos.teacherinfo_id','=','teacherinfos.tid')
                        ->where('studentcourseregistrations.sid',$id)->get();
        $deptcode = $student[0]->deptcode;
        $activeSemester = DB::table('active_semesters')->where('dept',$deptcode)->get();
        session()->put('activeYear',$activeSemester[0]->year);
        session()->put('activeSemester',$activeSemester[0]->semester);
        return view('students.studenthomepage')->with('student',$student[0])->with('regCourses',$regCourses);
    }


    /*Custom Functions*/

    public function showLoginForm()
    {
        return view('students.login');
    }

    /*For Login Authentication*/
    public function authenticate(Request $request)
    {
        $studentid = $request->get('studentid');
        $pass = $request->get('password');
        $studentInfo = Studentinfo::where('sid', '=', "$studentid")->first();
        if(!empty($studentInfo)){
            if($studentInfo->sid == $studentid && $studentInfo->spw == $pass){
                session()->put('studentid',$studentInfo->sid);
                session()->put('studentloginstatus',1);
                return redirect('student');
            }else{
                return back()->with('error',"*studentid or password was incorrect");
            }
        }else{
            return back()->with('error',"*studentid or password was incorrect");
        }


    }

    //for student logout
    public function logout()
    {
        session()->forget('studentloginstatus');
        session()->forget('activeYear');
        session()->forget('activeSemester');
        return redirect('');
    }

    //For showing the student home page
    public function showStudentHome()
    {
        return view('students.studenthomepage1');
    }

    //For showing the question form
    public function showQuestionForm($courseid,$sid)
    {

       $courseinfo =  DB::table('courseinfos')
                        ->join('teacherinfos','courseinfos.teacherinfo_id','=','teacherinfos.tid')
                        ->join('studentcourseregistrations','courseinfos.courseid','=','studentcourseregistrations.courseid')
                        ->select('courseinfos.courseid','teacherinfos.tid','qsetmcq','qsetopen','studentcourseregistrations.id','studentcourseregistrations.sid')
                        ->where([
                            ['courseinfos.courseid',$courseid],
                            ['studentcourseregistrations.sid',$sid]
                        ])->get();
       $mcq = DB::table('questionmcqs')
                    ->where('qset',$courseinfo[0]->qsetmcq)->get();
       $open = DB::table('questionopenendeds')
                    ->where('qset',$courseinfo[0]->qsetopen)->get();
       $mcqcategory = DB::table('questionmcqs')
                        ->select('categoryid','categorydesc')
                        ->distinct()->where('qset',$courseinfo[0]->qsetmcq)->get();
       $opencategory = DB::table('questionopenendeds')
                        ->select('categoryid','categorydesc')
                        ->distinct()->where('qset',$courseinfo[0]->qsetopen)->get();

        return view('students.question',['courseinfo'=>$courseinfo[0],'mcq'=>$mcq,
                                              'openended'=>$open,'mcqcategory'=>$mcqcategory,
                                                'opencategory'=>$opencategory]);

    }


    public function evaluation($cregid,Request $request)
    {
        $mcqid = $request->qidmcq;
        $mcqOptions = $request->qopdes;
        $openended = $request->openended;
        $qidopenended = $request->qidopenended;
        $sid = $request->sid;
        $this->validate($request,[
            'qopdes'=>'required',
            'openended' => 'required'
        ]);
        $response = 0;
        foreach ($mcqid as $qidmcq){
            if ($mcqOptions["$qidmcq"] == 1) {
                $response = 1;
            }elseif ($mcqOptions["$qidmcq"] == 2){
                $response = 2;
            }elseif ($mcqOptions["$qidmcq"] == 3){
                $response = 3;
            }elseif ($mcqOptions["$qidmcq"] == 4){
                $response = 4;
            }elseif ($mcqOptions["$qidmcq"] == 5){
                $response = 5;
            }
            $data['cregid'] = $cregid;
            $data['qidmcq'] = $qidmcq;
            $data['response'] = $response;
            DB::table('evaluatemcqs')
                ->insert($data);
        }
        foreach ($qidopenended as $qidopenended)
        {
            $data1['cregid'] = $cregid;
            $data1['qidopenended'] = $qidopenended;
            $data1['answerdesc'] = $openended[$qidopenended];
            DB::table('evaluateopenendeds')
                ->insert($data1);
        }
        $ev['evaluationstatus'] = 1;
        DB::table('studentcourseregistrations')
            ->where([
                ['id','=',$cregid],
                ['sid','=',$sid]
            ])
            ->update(['evaluationstatus' => 1]);

        return redirect('/student');
    }

}
