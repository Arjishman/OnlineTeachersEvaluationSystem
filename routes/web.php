<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Super Admin Routes
Route::get('/superadminlogin', 'SuperAdminController@showLoginForm');
Route::post('/superadmin', 'SuperAdminController@authenticate');
Route::group(['middleware' => 'superadmin'],function () {
    Route::get('/superadmin', 'SuperAdminController@index');
    Route::get('/superadmin/logout', "SuperAdminController@logout");
    Route::get('/superadmin/addadmin', 'SuperAdminController@create');
    Route::post('/superadmin/addadmin', 'SuperAdminController@store');
    Route::get('/superadmin/{empid}/edit', 'SuperAdminController@edit');
    Route::patch('/superadmin/{empid}', 'SuperAdminController@update');
    Route::delete('/superadmin/{empid}', 'SuperAdminController@destroy');
    Route::get('/superadmin/statusupdate', 'SuperAdminController@statusUpdate');
    Route::get('/superadmin/{empid}/resetpassword','SuperadminController@showAdminPasswordResetForm');
    Route::patch('/superadmin/{empid}','SuperadminController@adminPasswordReset');

    Route::get('/superadmin/selectactivesemester','SuperAdminController@showActiveSemester');
    Route::post('/superadmin/selectactivesemester','SuperAdminController@activeSemesterStore');
    Route::get('/superadmin/selectactivesemester/activestatusupdate','SuperAdminController@activeSemesterStatusUpdate');

});

//Admin Routes
Route::get('/adminlogin', 'AdminController@showLoginForm');
Route::post('/admin', 'AdminController@authenticate');
Route::group(['middleware' => 'admin'],function () {
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/logout', "AdminController@logout");

    //Routes for Fro Adding students and Showing students list
    Route::get('/admin/addstudents','AdminController@showStudentAddForm');
    Route::post('/admin/addstudents','AdminController@store');
    Route::get('/admin/students','AdminController@showStudentList');
    Route::post('/admin/students','AdminController@postImportStudents');
    Route::get('/admin/student/{sid}/editStudent','AdminController@editStudent');
    Route::patch('/admin/student/{sid}', 'AdminController@updateStudent');
    Route::delete('/admin/student/{sid}', 'AdminController@destroyStudent');

    //Routes for Adding Teachers and Showing students list
    Route::get('admin/teachers','AdminController@showTeachersList');
    Route::get('admin/addteacher','AdminController@showTeacherAddForm');
    Route::post('admin/addteacher','AdminController@storeTeachers');
    Route::delete('/admin/teacher/{tid}', 'AdminController@destroyTeacher');
    Route::get('/admin/teacher/{tid}/editTeacher', 'AdminController@editTeacher');
    Route::patch('/admin/teacher/{tid}', 'AdminController@updateTeacher');

    //Routes for adding Course information
    Route::get('/admin/courses','AdminController@showCourseList');
    Route::get("/admin/addcourse",'AdminController@showCourseAddForm');
    Route::post("/admin/addcourse",'AdminController@storeSingleCourse');
    Route::delete('/admin/course/{id}','AdminController@destroySingleCourse');
    Route::get('/admin/course/{id}/editcourse','AdminController@showEditSingleCourseForm');
    Route::patch('/admin/course/{id}','AdminController@updateEditedCourse');
    Route::get('/admin/course/statusupdate','AdminController@courseStatusUpdate');
    Route::post('/admin/courses','AdminController@postImportCourses');

    //Routes for Student Course Registration
    Route::get('/admin/course-registration', 'AdminController@showStudentCourseRegistration');
    Route::post('/admin/course-registration', 'AdminController@storeStudentCourseRegistration');
    Route::get('/admin/course-registration-list','AdminController@studentCourseRegistrationList');
    Route::delete('/admin/course-registration/{id}','AdminController@destroyStudentCourseRegistration');
    Route::patch('/admin/course-registration/{id}','AdminController@updateStudentCourseRegistration');
    Route::get('/admin/course-registration/{id}/edit','AdminController@editCourseRegistration');

    //Routes for Question infos
    Route::get('/admin/addquestions','AdminController@showQuestionPage');
    Route::post('/admin/addmcq','AdminController@addMcqQuestion');
    Route::post('/admin/addopenended','AdminController@addOpenEndedQuestion');
    Route::get('/admin/mcqqlist','AdminController@showMcqQuestionList');
    Route::delete('/admin/mcqqlist/{id}','AdminController@deleteMcqQuestion');
    Route::get('/admin/openendedqlist','AdminController@showOpenEndedQuestionList');
    Route::delete('/admin/openendedqlist/{id}','AdminController@deleteOpenEndedQuestion');

    //Routes for Evaluation Report
    Route::get('/admin/evaluationreport','AdminController@evaluationReport');
    Route::post('/admin/evaluationreport','AdminController@calculation');
    Route::post('/admin/addevaluationresult','AdminController@storeEvaluationResult');
    Route::get('/admin/allevaluationreport','AdminController@allEvaluationReport');
    Route::get('admin/teacher-select-course','AdminController@showSelectCourseForm');
    Route::post('admin/teacher-select-course','AdminController@showSelectCourseReport');
    Route::get('admin/teacher-select-course-pdf/{tid}/{year}/{semester}', [
        'as' => 'show-teacherEvaluationPdf', 'uses' => 'AdminController@showSelectCourseReportPdf']);
    Route::get('admin/show-tEvSingleCoursePdf/{tid}/{year}/{semester}/{courseid}', [
        'as' => 'show-tEvSingleCoursePdf', 'uses' => 'AdminController@calculationPdf']);


});

/*Student Routes*/
Route::get('/','StudentController@showLoginForm');
Route::post('/student','StudentController@authenticate');
Route::group(['middleware' => 'student'],function () {
    Route::get('/student','StudentController@index');
    Route::get('/student/logout','StudentController@logout');
    Route::get('/student/question/{courseid}/{sid}',"StudentController@showQuestionForm");
    Route::get('student/question/{courseid}/{sid}', [
        'as' => 'remindHelper', 'uses' => 'StudentController@showQuestionForm']);
    Route::post('/student/question/{cregid}',"StudentController@evaluation");

});


/*Teacher Routes*/
Route::get('/teacher/login','TeacherController@showLoginForm');
Route::post('/teacher','TeacherController@authenticate');
Route::group(['middleware' => 'teacher'],function (){
    Route::get('/teacher','TeacherController@index');
    Route::get('/teacher/logout','TeacherController@logout');
});


