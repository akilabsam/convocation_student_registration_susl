<?php

use App\Mail\HelloMail;
use App\Models\eligible_students;
use App\Models\EligibleStudent;
use App\Models\StudentRegistration;
use App\Models\VCorRegComment;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


use App\Http\Controllers\MailController;

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

Route::get('/', function () {
    //return view('maintence');
    return view('auth.login');
});

Route::get('/', function () {
    //return view('maintence');
    return view('auth.login');
})->name('welcome');

// Route::get('/hello', function () {
//     $regNum = '21CIS0138'; 
//     Mail::to('sajithsampath721@gmail.com')
//         ->send(new HelloMail($regNum));
//     return view('auth.login');
// })->name('hello');

//Route::get('/', function () {
//    return view('survey.create');
//});


//Route::get('/eligibleStd', function () {
//    session_start();
//
//    $stdEmail = $_SESSION["email"];
//
//    $studentRegistrations = StudentRegistration::all();
//    $eligibleStudents = EligibleStudent::all();
//    return view('eligibleStd',compact('eligibleStudents','studentRegistrations','stdEmail'));
//
//});

Route::get('/eligibleStd',[App\Http\Controllers\StudentRegistrationController::class, 'eligibleStd'])->name('eligibleStd');
Route::get('/surveyView',[App\Http\Controllers\SurveyController::class, 'surveyView'])->name('surveyView');
Route::get('/checkData',[App\Http\Controllers\MailController::class, 'checkData'])->name('checkData');
Route::get('/submit-google-survey',[App\Http\Controllers\SurveyController::class, 'submitGoogleSurvey'])->name('submitGoogleSurvey');
Route::post('/mark-survey-completed',[App\Http\Controllers\SurveyController::class, 'markSurveyCompleted'])->name('markSurveyCompleted');
Route::get('/check-survey-status',[App\Http\Controllers\SurveyController::class, 'checkSurveyStatus'])->name('checkSurveyStatus');
Route::post('/reset-survey-completion',[App\Http\Controllers\SurveyController::class, 'resetSurveyCompletion'])->name('resetSurveyCompletion');


Route::get('/check', function () {
    return view('check');
});

Route::get('/loginFilter', function () {
    return view('loginFilter');
});

Route::get('/completeEmailVerify', function () {
    return view('completeEmailVerify');
});

Route::get('/emailSentView', function () {
    return view('emailSentView');
});

Route::get('/wrongRegistrationNumber', function () {
    return view('wrongRegistrationNumber');
});

Route::get('/verifyEmail', function () {
    return view('verifyEmail');
});

Route::get('/checkedData', function () {
    return view('checkedData');
});


Route::post('emailGet/{email}', [App\Http\Controllers\EligibleStudentsController::class, 'emailGet'])->name('emailGet');




Route::get('/mail',[MailController::class, 'sendMail'])->name('mail');;
Route::post('/sendConfirmedMail',[MailController::class, 'sendConfirmedMail'])->name('sendConfirmedMail');;
Route::get('/loginfilter',[MailController::class, 'loginfilter'])->name('loginfilter');;

Route::put('/statusConfirm',[App\Http\Controllers\EligibleStudentsController::class, 'statusConfirm'])->name('statusConfirm');;


Route::post('/statusConfirm',[App\Http\Controllers\StudentRegistrationController::class, 'registerdReset'])->name('statusConfirm');;
// Route::get('/send-registration-mail/{email}', [MailController::class, 'SurveyController'])->name('RegistrationSendMail');



Route::get('/completeEmailVerification',[App\Http\Controllers\EligibleStudentsController::class, 'completeEmailVerification'])->name('completeEmailVerification');;
Route::get('/getByEmail',[App\Http\Controllers\EligibleStudentsController::class, 'getByEmail'])->name('getByEmail');;
Route::get('/getByRegNum',[App\Http\Controllers\EligibleStudentsController::class, 'getByRegNum'])->name('getByRegNum');
Route::get('/getESByFormRequest',[App\Http\Controllers\EligibleStudentsController::class, 'getESByFormRequest'])->name('getESByFormRequest');
Route::get('/getESByRegNum', [App\Http\Controllers\EligibleStudentsController::class, 'getESByRegNum'])->name('getESByRegNum');





Auth::routes();

Route::get('/home', [App\Http\Controllers\EligibleStudentsController::class, 'index'])->name('home');
//Route::get('/home',[MailController::class, 'sendConfirmedMail'])->name('sendConfirmedMail');




//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('eligibleStudents', \App\Http\Controllers\EligibleStudentsController::class);
Route::resource('studentRegistration', \App\Http\Controllers\StudentRegistrationController::class);
Route::resource('report', \App\Http\Controllers\ReportController::class);
Route::resource('faculty', \App\Http\Controllers\FacultyController::class);
Route::resource('convocation', \App\Http\Controllers\ConvocationController::class);
Route::resource('price', \App\Http\Controllers\PriceController::class);
Route::resource('survey', \App\Http\Controllers\SurveyController::class);
Route::resource('user', \App\Http\Controllers\UserController::class);


//Route::get('/getPDF', [App\Http\Controllers\PDFController::class, 'download']);

Route::group(['middleware'=>'auth'], function () {
    Route::get('permissions-all-users',['middleware'=>'check-permission:user|admin|superadmin','uses'=>'HomeController@allUsers']);
    Route::get('permissions-admin-superadmin',['middleware'=>'check-permission:admin|superadmin','uses'=>'HomeController@adminSuperadmin']);
    Route::get('permissions-superadmin',['middleware'=>'check-permission:superadmin','uses'=>'HomeController@superadmin']);
});


Route::get('/edit-records','App\Http\Controllers\UserDetailsController@index');
Route::get('edit/{id}','App\Http\Controllers\UserDetailsController@show');
Route::post('edit/{id}','App\Http\Controllers\UserDetailsController@edit');
Route::get('delete/{id}','App\Http\Controllers\UserDetailsController@destroy');


//Route::post('/eligible_students/updateDetail',[\App\Http\Controllers\EligibleStudentsController0::class,'updateDetail'])->name('eligible_students.updateDetail');
Route::get('/import-users', [\App\Http\Controllers\EligibleStudentsController::class, 'importstudents'])->name('importstudents');
Route::post('/upload-users', [\App\Http\Controllers\EligibleStudentsController::class, 'uploadstudents'])->name('uploadstudents');

Route::get('/export', [\App\Http\Controllers\StudentRegistrationController::class, 'export'])->name('export');;
Route::get('/exportbyfaculty', [\App\Http\Controllers\StudentRegistrationController::class, 'exportbyfaculty'])->name('exportbyfaculty');;
Route::get('/eligiblestudentreset', [\App\Http\Controllers\StudentRegistrationController::class, 'eligiblestudentreset'])->name('eligiblestudentreset');;

Route::get('/exportsurvey', [\App\Http\Controllers\SurveyController::class, 'exportSurvey'])->name('exportsurvey');;

Route::get('/registerdreset', [\App\Http\Controllers\StudentRegistrationController::class, 'registerdreset'])->name('registerdreset');;
Route::get('/registerdwithsurveyreset', [\App\Http\Controllers\StudentRegistrationController::class, 'registerdwithsurveyreset'])->name('registerdwithsurveyreset');;

Route::get('/forget-password', '\App\Http\Controllers\Auth\ForgotPasswordController@getEmail');
Route::post('/forget-password', '\App\Http\Controllers\Auth\ForgotPasswordController@postEmail');


Route::get('/reset-password/{token}', '\App\Http\Controllers\Auth\ResetPasswordController@showResetForm');
Route::post('/reset-password', '\App\Http\Controllers\Auth\ResetPasswordController@reset');

Route::get('/tab1',function (){
    return view('home');
});
Route::get('/tab2',function (){
    return view('home');
});
Route::get('/tab3',function (){
    return view('home');
});
