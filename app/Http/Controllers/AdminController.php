<?php

namespace App\Http\Controllers;

use App\ActiveSemester;
use App\Admininfo;
use App\Courseinfo;
use App\Evaluationresult;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Student;
use App\Imports\CourseImport;
use App\Imports\StudentImport;
use App\Imports\TeacherImport;
use App\Imports\UsersImport;
use App\Questionmcq;
use App\Questionopenended;
use App\Questionset;
use App\Studentcourseregistration;
use App\Studentinfo;
use App\Teacherinfo;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Files\Disk;
use phpDocumentor\Reflection\Types\True_;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Question\Question;
use function GuzzleHttp\Promise\all;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('empid');
        $admin = DB::table('admininfos')->select('deptcode')->where('empid',$id)->first();
        $deptcode = $admin->deptcode;
        $activeSemester = DB::table('active_semesters')->where('dept','like',"$deptcode")->first();
        if (!empty($activeSemester)){
            session()->put('activeYear',$activeSemester->year);
            session()->put('activeSemester',$activeSemester->semester);
        }else{
            session()->put('activeYear','No active Year Chosen');
            session()->put('activeSemester','No active semester Chosen');
        }
        return view('admin.adminDashboard');
    }

    public function showLoginForm()
    {
       return view('admin.login');
    }

    public function showStudentAddForm()
    {
        return view('admin.addstudents');
    }


    //for uploading students from Excel sheet
    public function postImportStudents(Request $r)
    {
        if ($r->hasFile('file')){
            $file = $r->file('file')->store('import');
            (new StudentImport)->import($file);
            return back()->with('success',"Students Added Successfully!!");
        }
    }


    public function authenticate(Request $request)
    {
        $id = $request->userid;
        $pass = $request->password;
        $admin =  Admininfo::where('empid', '=', "$id")->first();
        if ($admin != "") {
            $deptcode = $admin->deptcode;
            if ($admin->empid == $id && Hash::check($pass, $admin->emppw)) {
                if ($admin->empactivitystatus == 1) {
                    session()->put('empdata', 1);
                    session()->put('empid',$id);
                    session()->put('empDeptcode',$deptcode);
                    return redirect('/admin');
                } else {
                    return redirect('/adminlogin')->with('error',"*You don't have permission to login");
                }
            }else{
                return redirect('/adminlogin')->with('error',"*User id or Password was incorrect");
            }
        }else{
            return redirect('/adminlogin')->with('error',"*User id or Password was incorrect");
        }

    }

    //For Admin Logout
    public function logout(){
        session()->forget('empdata');
        session()->forget('empid');
        session()->forget('empDeptcode');
        session()->forget('currentYear');
        session()->forget('CurrentSemester');
        return redirect('adminlogin');
    }

    //Showing Student list
    public function showStudentList()
    {
        $id = session('empid');
        $admin = DB::table('admininfos')->select('deptcode')->where('empid',$id)->get();
        $deptcode = $admin[0]->deptcode;
        $student = Studentinfo::where('deptcode','like',"$deptcode")->paginate(10);
        return view('admin.studentslist')->with('students',$student);

    }

    //Show Editing form of a single Student
    public function editStudent($id)
    {
        $student = DB::table('studentinfos')
                    ->where('sid', $id)->first();
        return view('admin.editStudent')->with('student',$student);
    }
    //Update Edited Student
    public function updateStudent(Request $request,$id)
    {
        $this->validate($request,[
            'sname' => 'required',
            'semail' => 'required|email',
            'sid' => "required",
            'deptcode' => 'required'
        ]);

        $data['sid'] = $request->sid;
        $data['semail'] = $request->semail;
        $data['deptcode'] = $request->deptcode;
        $data['sname'] = $request->sname;

        DB::table('studentinfos')
            ->where('sid',$id)
            ->update($data);

        return redirect('admin/students')->with('success','Successfully Updated!!!');
    }


    //Functions for Adding teachers and Teachers list
    public function showTeachersList()
    {
        $deptcode = session('empDeptcode');
        $teachers = Teacherinfo::where('deptcode','like',"$deptcode")->paginate(10);
        return view('admin.teacherslist')->with('teachers',$teachers);
    }

    public function showTeacherAddForm()
    {
        return view('admin.addTeachers');
    }

    public function storeTeachers(Request $request)
    {
        $this->validate($request, [
            'tid' => 'required|unique:teacherinfos,tid',
            'tname' => 'required',
            'deptcode' => 'required',
            'password' => 'required'
        ]);
        Teacherinfo::create($request->all());
        return redirect('admin/teachers')->with('success','Successfully Added!!!');


    }

    //Show Edit Teacher Form
    public function editTeacher($id)
    {
        $teacher = DB::table('teacherinfos')
                ->where('tid',$id)->first();
        return view('admin/editTeacher')->with('teacher',$teacher);
    }

    //Storing Updated Teacher informations
    public function updateTeacher(Request $request,$id)
    {
        $this->validate($request,[
            'tid'=>'required',
            'tname' => 'required'
        ]);
        $data['tid'] = $request->tid;
        $data['tname'] = $request->tname;
        $data['deptcode'] = $request->deptcode;
        $d['teacherinfo_id'] = $request->tid;

        DB::table('teacherinfos')
        ->where('tid',$id)
        ->update($data);
        return redirect('admin/teachers')->with('success','Successfully Updated!!!');
    }


//Storing single Student
    public function store(Request $request)
    {
        $this->validate($request,[
            'sname' => 'required',
            'semail'=> 'required|unique:studentinfos,semail',
            'sid' => 'required|unique:studentinfos,sid',
            'deptcode' => 'required'
        ]);

        $data = new Studentinfo();
        $data->sname = $request->sname;
        $data->sid = $request->sid;
        $data->semail = $request->semail;
        $data->deptcode = $request->deptcode;
        $data->save();
        return redirect("admin/students")->with('success','Successfully Added!!!');
    }


    //Show Course List Page
    public function showCourseList()
    {
        $id = session('empid');
        $admin = DB::table('admininfos')->select('deptcode')->where('empid',$id)->get();
        $deptcode = $admin[0]->deptcode;
        $courses = Courseinfo::where('deptcode','like',"$deptcode")->paginate(10);
        return view('admin.courseInfo.courseList')->with('courses',$courses);
    }

    //Show Add single course add form

    public function showCourseAddForm(){
        $tid = DB::table('teacherinfos')->select('tid')
                        ->where('deptcode',session('empDeptcode'))->get();
        $qsetmcq = DB::table('questionmcqs')
                    ->select('qset')->distinct()->get();
        $qsetopen = DB::table('questionopenendeds')
                    ->select('qset')->distinct()->get();
        return view('admin.courseInfo.addcourse')->with('tid',$tid)->with('qsetmcq',$qsetmcq)->with('qsetopen',$qsetopen);
    }

    //Storing a single course
    public function storeSingleCourse(Request $request)
    {
        $this->validate($request,[
           'courseid' => 'required|unique:courseinfos,courseid',
            'year' => 'required',
            'semester' => 'required',
            'part' => 'required',
            'teacherinfo_id' => 'required',
            'deptcode' => 'required'
        ]);

        Courseinfo::create($request->all());
        return redirect('admin/courses')->with('success','Successfully Added!!!');
    }

    //Store Course Informations from Excel
    public function postImportCourses(Request $r)
    {
        if ($r->hasFile('file')){
            $file = $r->file('file')->store('import');
            (new CourseImport())->import($file);
            return back()->with('success','Successfully Added!!!');
        }
    }

    //Show Edit Course form
    public function showEditSingleCourseForm($id){
        $course = DB::table('courseinfos')
            ->where('id',$id)->first();
        $tid = DB::table('teacherinfos')
                ->select('tid')->get();
        $qsetmcq = DB::table('questionmcqs')
            ->select('qset')->distinct()->get();
        $qsetopen = DB::table('questionopenendeds')
            ->select('qset')->distinct()->get();
        return view('admin.courseInfo.editCourse')->with('course',$course)->with('tid',$tid)->with('qsetmcq',$qsetmcq)->with('qsetopen',$qsetopen);;
    }

    //update Edited Course information
    public function updateEditedCourse($id, Request $request)
    {
        $this->validate($request,[
            'courseid' => 'required',
            'year' => 'required',
            'semester' => 'required',
            'part' => 'required',
            'teacherinfo_id' => 'required',
            'deptcode' => 'required'
        ]);

        $data['courseid'] = $request->courseid;
        $data['year'] = $request->year;
        $data['semester'] = $request->semester;
        $data['part'] = $request->part;
        $data['teacherinfo_id'] = $request->teacherinfo_id;
        $data['deptcode'] = $request->deptcode;
        $data['qsetmcq'] = $request->qsetmcq;
        $data['qsetopen'] = $request->qsetopen;

        DB::table('courseinfos')
            ->where('id',$id)
            ->update($data);
        return redirect('admin/courses')->with('success','Successfully updated!!!');
    }

    //Delete the requested Course Information
    public function destroySingleCourse($id)
    {
        DB::table('courseinfos')
                    ->where('id', $id)->delete();
        return redirect('admin/courses')->with('success','Successfully Deleted!!!');
    }

    //Update the Evaluation open or close status
    public function courseStatusUpdate(Request $request)
    {
        $id = $request->user_id;
        $status = $request->status;
        DB::table('courseinfos')
            ->where('id',$id)
            ->update(['openforevaluation'=> $status]);
        return response()->json(['success'=>'Status change successfully.']);
    }


    //Show Student Course Registration Form
    public function showStudentCourseRegistration()
    {
        $deptcode = session('empDeptcode');
        $sid = DB::table('studentinfos')
                ->select('sid')
                ->where('deptcode',$deptcode)->get();
        $cid = DB::table('courseinfos')
                ->select('courseid')
                ->where('deptcode',$deptcode)->get();
        return view('admin.studentCourseRegistration.studentCourseRegistration')->with('sid',$sid)->with('cid',$cid);
    }

    //Store Student Course Registration
    public function storeStudentCourseRegistration(Request $request)
    {
        $this->validate($request,[
            'courseid' => 'required',
            'sid' => 'required'
        ]);

        Studentcourseregistration::create($request->all());
        return redirect('/admin/course-registration-list')->with('success','Successfully Added!!!');
    }

    //Show Student Course Registration List
    public function studentCourseRegistrationList()
    {
        $deptcode = session('empDeptcode');
        $c =  DB::table('studentcourseregistrations')
                ->join('studentinfos', 'studentcourseregistrations.sid','like', 'studentinfos.sid')
                ->where('studentinfos.deptcode',$deptcode)->paginate(10);
        return view('admin.studentCourseRegistration.studentCourseRegistrationList')->with('courseReg',$c);

    }

    //Delete a Student Course Registration Form
    public function destroyStudentCourseRegistration($id)
    {
        DB::table('studentcourseregistrations')->where('id', "$id")->delete();
        return redirect('/admin/course-registration-list');
    }

    //Update a Student Course Registration Form
    public function updateStudentCourseRegistration($id,Request $request)
    {
        $this->validate($request,[
            'courseid' => 'required',
            'sid' => 'required'
        ]);

        $data['courseid'] = $request->courseid;
        $data['sid'] = $request->sid;
        DB::table('studentcourseregistrations')
            ->where('id',$id)
            ->update($data);
        return redirect('/admin/course-registration-list')->with('success','Successfully Updated!!!');
    }

    //Show Student Course Registration Editing Form
    public function editCourseRegistration($id)
    {
        $data = Studentcourseregistration::find($id);

        $deptcode = session('empDeptcode');
        $sid = DB::table('studentinfos')
            ->select('sid')
            ->where('deptcode',$deptcode)->get();
        $cid = DB::table('courseinfos')
            ->select('courseid')
            ->where('deptcode',$deptcode)->get();
        return view('admin.studentCourseRegistration.editCourseRegistration')->with('data',$data)->with('sid',$sid)->with('cid',$cid);
    }

    //Deleting an Student info
    public function destroyStudent($id)
    {
        DB::table('studentinfos')->where('sid', "$id")->delete();
        return redirect('admin/students')->with('success','Successfully Deleted!!!');
    }

    //Deleting an Teacher Information:
    public function destroyTeacher($id)
    {
        $t = DB::table('courseinfos')
                    ->where('courseid',$id)->first();
        if (!empty($t)){
            DB::table('teacherinfos')->where('tid',$id)->delete();
            return redirect('admin/teachers')->with('success','Successfully Deleted!!!');
        }else{
            return redirect('admin/teachers')->with('alert',"You can't delete this. This teacher id is assigned to a course!!");
        }
    }

    //Show question set page
    public function showQuestionPage()
    {
        return view('admin.questioninfo.setquestions');
    }

    //Storing the new mcq question
    public function addMcqQuestion(Request $request)
    {
        Questionmcq::create($request->all());
        return response()->json(['success'=>'Question set added successfully.']);

    }

    //Storing the new open ended questoin
    public function addOpenEndedQuestion(Request $request)
    {
        Questionopenended::create($request->all());

        return response()->json(['success'=>'Question set added successfully.']);
    }

    //Showing the MCq Question list form
    public function showMcqQuestionList()
    {
        $deptcode = session('empDeptcode');
        $mcq = DB::table('questionmcqs')
                    ->where('deptcode','like',$deptcode)->paginate(10);
        return view('admin.questioninfo.mcqQuestionList')->with('mcq',$mcq);
    }

    //Showing the Open Ended Question List
    public function showOpenEndedQuestionList()
    {
        $deptcode = session('empDeptcode');
        $openended = DB::table('questionopenendeds')
                        ->where('deptcode','like',$deptcode)->paginate(10);
        return view('admin.questioninfo.openEndedList')->with('openended',$openended);
    }
    //Delete a mcq question
    public function deleteMcqQuestion($id)
    {
        DB::table('questionmcqs')->where('id', "$id")->delete();
        return redirect('/admin/mcqqlist')->with('success','Successfully Deleted!!!');
    }

    //Delete a open ended question
    public function deleteOpenEndedQuestion($id)
    {
        DB::table('questionopenendeds')->where('id', "$id")->delete();
        return redirect('admin/openendedqlist')->with('success','Successfully Deleted!!!');
    }


    //For showing the Evaluation Report Selecting course id tid year semester page page
    public function evaluationReport()
    {
        $dept = session('empDeptcode');
        $courseinfo = DB::table('evaluatemcqs')
                        ->join('studentcourseregistrations','evaluatemcqs.cregid','=','studentcourseregistrations.id')
                        ->join('courseinfos','studentcourseregistrations.courseid','=','courseinfos.courseid')
                        ->select('courseinfos.courseid','courseinfos.teacherinfo_id')->distinct()
                        ->where('courseinfos.deptcode',$dept)->get();


        return view('admin.evaluationreport')->with('courseinfo',$courseinfo);
    }
//For showing the calculation page for the selected course
    public function calculation(Request $request)
    {
        $semester = $request->semester;
        $year = $request->year;
        $deptcode = $request->deptcode;
        $courseid = $request->courseid;
        $tid = $request->tid;
        //Course Year semester verification
        $a = DB::table('courseinfos')
            ->where('courseid',$courseid)->get();

        if ($a[0]->year == $year && $a[0]->semester == $semester && $a[0]->deptcode == $deptcode && $a[0]->teacherinfo_id == $tid){
            $mcq = DB::table('studentcourseregistrations')
                        ->join('evaluatemcqs','studentcourseregistrations.id','=','evaluatemcqs.cregid')
                        ->join('questionmcqs','evaluatemcqs.qidmcq','=','questionmcqs.id')
                        ->where('studentcourseregistrations.courseid',$courseid)->get();
            $mcqcategories = DB::table('studentcourseregistrations')
                            ->join('evaluatemcqs','studentcourseregistrations.id','=','evaluatemcqs.cregid')
                            ->join('questionmcqs','evaluatemcqs.qidmcq','=','questionmcqs.id')
                            ->select('questionmcqs.categoryid','questionmcqs.categorydesc')->distinct()
                             ->where('studentcourseregistrations.courseid',$courseid)->get();

            $openended = DB::table('studentcourseregistrations')
                            ->join('evaluateopenendeds','studentcourseregistrations.id','=','evaluateopenendeds.cregid')
                            ->join('questionopenendeds','evaluateopenendeds.qidopenended','=','questionopenendeds.id')
                            ->where('studentcourseregistrations.courseid',$courseid)->get();

            $openendedcategories = DB::table('studentcourseregistrations')
                ->join('evaluateopenendeds','studentcourseregistrations.id','=','evaluateopenendeds.cregid')
                ->join('questionopenendeds','evaluateopenendeds.qidopenended','=','questionopenendeds.id')
                ->select('questionopenendeds.categoryid','questionopenendeds.categorydesc')->distinct()
                ->where('studentcourseregistrations.courseid',$courseid)->get();

            return view('admin.showEvaluationReport')->with('mcq',$mcq)->with('mcqctg',$mcqcategories)
                                                            ->with('tid',$tid)->with('courseid',$courseid)
                                                            ->with('open',$openended)->with('openctg',$openendedcategories)
                                                            ->with('year',$year)->with('semester',$semester);

        }else{
            return back()->with('error','Data Record Not founded');
        }
    }

    public function calculationPdf($tid,$year,$semester,$courseid)
    {
        $deptcode = session('empDeptcode');
        $a = DB::table('courseinfos')
            ->where('courseid',$courseid)->get();
        $mcq = DB::table('studentcourseregistrations')
            ->join('evaluatemcqs','studentcourseregistrations.id','=','evaluatemcqs.cregid')
            ->join('questionmcqs','evaluatemcqs.qidmcq','=','questionmcqs.id')
            ->where('studentcourseregistrations.courseid',$courseid)->get();
        $mcqcategories = DB::table('studentcourseregistrations')
            ->join('evaluatemcqs','studentcourseregistrations.id','=','evaluatemcqs.cregid')
            ->join('questionmcqs','evaluatemcqs.qidmcq','=','questionmcqs.id')
            ->select('questionmcqs.categoryid','questionmcqs.categorydesc')->distinct()
            ->where('studentcourseregistrations.courseid',$courseid)->get();

        $openended = DB::table('studentcourseregistrations')
            ->join('evaluateopenendeds','studentcourseregistrations.id','=','evaluateopenendeds.cregid')
            ->join('questionopenendeds','evaluateopenendeds.qidopenended','=','questionopenendeds.id')
            ->where('studentcourseregistrations.courseid',$courseid)->get();

        $openendedcategories = DB::table('studentcourseregistrations')
            ->join('evaluateopenendeds','studentcourseregistrations.id','=','evaluateopenendeds.cregid')
            ->join('questionopenendeds','evaluateopenendeds.qidopenended','=','questionopenendeds.id')
            ->select('questionopenendeds.categoryid','questionopenendeds.categorydesc')->distinct()
            ->where('studentcourseregistrations.courseid',$courseid)->get();
        $file_name = "$courseid"."Evaluation Report".".pdf";
        $mpdf = new \Mpdf\Mpdf([

        ]);

        $mpdf->setFooter('{PAGENO}');

        $html = \View::make('admin.PDFshowEvaluationReport')->with('mcq',$mcq)->with('mcqctg',$mcqcategories)
                ->with('tid',$tid)->with('courseid',$courseid)
                ->with('open',$openended)->with('openctg',$openendedcategories)
                ->with('year',$year)->with('semester',$semester);;

        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name,'I');

    }

    public function storeEvaluationResult(Request $request)
    {
        DB::table('evaluationresults')->updateOrInsert(
            ['courseid'=>$request->courseid,'year'=>$request->year,'semester'=>$request->semester,'tid'=>$request->tid],
            ['positive_response'=>$request->positive_response,'mean_score'=>$request->mean_score,'total_weight'=>$request->total_weight]
        );

        return response()->json(['success'=>'Evaluation report added successfully.']);

    }

    //For showing all the evaluation report in a short form
    public function allEvaluationReport()
    {
        $data = DB::table('evaluationresults')
                    ->orderBy('tid','asc')
                    ->orderBy('courseid','asc')->get();
        return view('admin.all_evaluation_report')->with('data',$data);
    }

    //For showing the teacher registered courses Selection form for showing the report under registered courses.
    public function showSelectCourseForm()
    {
        $deptcode = session('empDeptcode');
        $data = Teacherinfo::where('deptcode',$deptcode)->get();
        return view('admin.teacher-allCourse-report1')->with('teacherInfo',$data);
    }
    //Showing the teacher evaluation report by the selected year semester and teacher id
    public function showSelectCourseReport(Request $request)
    {
        $tid = $request->tid;
        $deptcode = $request->deptcode;
        $year = $request->year;
        $semester = $request->semester;
        $teacherInfo = Teacherinfo::where('tid',$tid)->first();
        $mcq = DB::table('teacherinfos')
                    ->join('evaluationresults','teacherinfos.tid','=','evaluationresults.tid')
                    ->where([
                       ['teacherinfos.tid',$tid],
                       ['evaluationresults.year',$year],
                       ['evaluationresults.semester',$semester],
                    ])->get();
        $openended = DB::table('courseinfos')
                        ->join('studentcourseregistrations','courseinfos.courseid','=','studentcourseregistrations.courseid')
                        ->join('evaluateopenendeds','studentcourseregistrations.id','=','evaluateopenendeds.cregid')
                        ->join('questionopenendeds','evaluateopenendeds.qidopenended','=','questionopenendeds.id')
                        ->where([
                            ['courseinfos.teacherinfo_id',$tid],
                            ['courseinfos.year',$year],
                            ['courseinfos.semester',$semester]
                        ])->get();
        $openendedQuestion = Questionopenended::where('deptcode',session('empDeptcode'))->get();

        if (sizeof($mcq) != 0 && sizeof($openended) != 0){
            return view('admin.teacher-allCourse-showReport')->with('mcq',$mcq)->with('openResult',$openended)
                ->with('qopen',$openendedQuestion)->with('teacherInfo',$teacherInfo)
                ->with('semester',$semester)->with('year',$year);
        }else{
            return back()->with(['error'=>"No Result Founded"]);
        }

    }

    public function showSelectCourseReportPdf($tid,$year,$semester)
    {
       $teacherInfo = Teacherinfo::where('tid',$tid)->first();
        $mcq = DB::table('teacherinfos')
            ->join('evaluationresults','teacherinfos.tid','=','evaluationresults.tid')
            ->where([
                ['teacherinfos.tid',$tid],
                ['evaluationresults.year',$year],
                ['evaluationresults.semester',$semester],
            ])->get();
        $openended = DB::table('courseinfos')
            ->join('studentcourseregistrations','courseinfos.courseid','=','studentcourseregistrations.courseid')
            ->join('evaluateopenendeds','studentcourseregistrations.id','=','evaluateopenendeds.cregid')
            ->join('questionopenendeds','evaluateopenendeds.qidopenended','=','questionopenendeds.id')
            ->where([
                ['courseinfos.teacherinfo_id',$tid],
                ['courseinfos.year',$year],
                ['courseinfos.semester',$semester]
            ])->get();
        $openendedQuestion = Questionopenended::where('deptcode',session('empDeptcode'))->get();

        $pdf = PDF::loadView('admin.PDFshowEvaluationReport')->with('mcq',$mcq)->with('openResult',$openended)
            ->with('qopen',$openendedQuestion)->with('teacherInfo',$teacherInfo)
            ->with('semester',$semester)->with('year',$year);

        $pdf->render();
        $pdf->stream("hello.pdf");

       /*$file_name = "$teacherInfo->tname"."report".".pdf";
       $mpdf = new \Mpdf\Mpdf([
           'margin_left' => 10,
           'margin_right' => 10,
           'margin_top' => 15,
           'margin_bottom' => 20,
           'margin_header' => 10,
           'margin_footer' =>10
       ]);

       $mpdf->setFooter('{PAGENO}');

       $html = \View::make('admin.PDF-teacher-allCourse-showReport')->with('mcq',$mcq)->with('openResult',$openended)
           ->with('qopen',$openendedQuestion)->with('teacherInfo',$teacherInfo)
           ->with('semester',$semester)->with('year',$year);

       $html = $html->render();
       $mpdf->WriteHTML($html);
       $mpdf->Output($file_name,'I');*/

    }

}
