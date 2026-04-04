<?php

namespace App\Http\Controllers;

use App\Models\Convocation;
use App\Models\EligibleStudent;
use App\Models\StudentRegistration;
use App\Models\VerifiedEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use App\Imports\StudentsImport;

class EligibleStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session_start();
        // $convo = Convocation::orderBy('convocation', 'desc')->pluck('convocation', 'id');
        $convo = Convocation::orderBy('convocation', 'asc')->pluck('convocation', 'id');
        $lastConvocation = DB::table('convocations')
        ->orderBy('id', 'desc')
        ->value('convocation');
        
//        $stdEmail = $_SESSION["email"];
        $students = DB::select('
SELECT
eligible_students.id,
student_registrations.id as "sid",
eligible_students.nameWithInitials,
eligible_students.regNum,
eligible_students.indexNum,
eligible_students.faculty,
eligible_students.department,
eligible_students.degreeName,
eligible_students.cloakIssueDate,
eligible_students.cloakReturnDate,
eligible_students.garlandReturnDate,
student_registrations.status,
surveys.id as "svid"

FROM eligible_students
LEFT JOIN student_registrations ON eligible_students.regNum = student_registrations.regNum
LEFT JOIN surveys ON student_registrations.regNum = surveys.regNum
WHERE eligible_students.convocationName = ?;
', [$lastConvocation]);



//        $studentRegistrations = StudentRegistration::all();
//        $eligibleStudents = EligibleStudent::all();

        return view('eligibleStudents.index',compact('students','convo'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $convo = Convocation::all()->pluck('convocation', 'id');
        return view('eligibleStudents.create',compact('convo'));
    }

//    public function show()
//    {
//           }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $convo = Convocation::all()->pluck('convocation', 'id');
        $pro=new EligibleStudent();
        $pro->nameWithInitials = $request->nameWithInitials;
        $pro->gender = $request->gender;
        $pro->degreeName = $request->degreeName;
        $pro->regNum = $request->regNum;
        $pro->indexNum = $request->indexNum;
        $pro->degreeClass = $request->degreeClass;
        $pro->faculty = $request->faculty;
        $pro->department = $request->department;
        $pro->convocationName = $convo[$request->convocationName];
        $pro->save();
//        EligibleStudent::create($request->all());
        return redirect()->route('eligibleStudents.index')
            ->with('success','Student add successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EligibleStudent  $eligibleStudent
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,EligibleStudent $eligibleStudent)
    {



//        $studentRegistrations = StudentRegistration::all();
//        $eligibleStudents = EligibleStudent::all();
//        return view('eligibleStudents.show',compact('eligibleStudents','studentRegistrations'));

    }


    public function getESByFormRequest(Request $request)
    {
        $convo = Convocation::orderBy('convocation', 'asc')->pluck('convocation', 'id');
        $studentRegEligible = $request->input('studentRegEligible');
        $faculty = $request->input('faculty');
        $convocationName = $convo[$request->input('convocationName')];



        if($request->input('studentRegEligible')=="All") {
            if($request->input('faculty')!="All Faculty"){
                $students = collect(DB::select('

SELECT
eligible_students.id,
student_registrations.id as "sid",
eligible_students.nameWithInitials,
eligible_students.regNum,
eligible_students.indexNum,
eligible_students.faculty,
eligible_students.department,
eligible_students.degreeName,
eligible_students.cloakIssueDate,
eligible_students.cloakReturnDate,
eligible_students.garlandReturnDate,
eligible_students.convocationName,
student_registrations.status,
surveys.id as "svid"

FROM eligible_students
LEFT JOIN student_registrations ON eligible_students.regNum=student_registrations.regNum
LEFT JOIN surveys ON student_registrations.regNum = surveys.regNum;
'))->where('faculty', '=', $faculty)
                    ->where('convocationName', '=', $convocationName);
            }else{
                $students = collect(DB::select('

SELECT
eligible_students.id,
student_registrations.id as "sid",
eligible_students.nameWithInitials,
eligible_students.regNum,
eligible_students.indexNum,
eligible_students.faculty,
eligible_students.department,
eligible_students.degreeName,
eligible_students.cloakIssueDate,
eligible_students.cloakReturnDate,
eligible_students.garlandReturnDate,
eligible_students.convocationName,
student_registrations.status,
surveys.id as "svid"

FROM eligible_students
LEFT JOIN student_registrations ON eligible_students.regNum=student_registrations.regNum
LEFT JOIN surveys ON student_registrations.regNum = surveys.regNum;
'))->where('convocationName', '=', $convocationName);
            }
     if ($request->ajax()) {
                return view('eligibleStudents._students_tbody', compact('students'));
            }
            return view('eligibleStudents.index',compact('students','convo'));

        }

        elseif ($request->input('studentRegEligible')=="Registered"){

            if($request->input('faculty')!="All Faculty"){

                $students = collect(DB::select('

SELECT
student_registrations.id as "sid",
eligible_students.id,
eligible_students.nameWithInitials,
eligible_students.regNum,
eligible_students.indexNum,
eligible_students.faculty,
eligible_students.department,
eligible_students.degreeName,
eligible_students.cloakIssueDate,
eligible_students.cloakReturnDate,
eligible_students.garlandReturnDate,
eligible_students.convocationName,
student_registrations.status,
surveys.id as "svid"

FROM eligible_students
INNER JOIN student_registrations ON eligible_students.regNum=student_registrations.regNum
LEFT JOIN surveys ON student_registrations.regNum = surveys.regNum;
'))->where('faculty', '=', $faculty)
                    ->where('convocationName', '=', $convocationName);
            }else{
                $students = collect(DB::select('

SELECT
student_registrations.id as "sid",
eligible_students.id,
eligible_students.nameWithInitials,
eligible_students.regNum,
eligible_students.indexNum,
eligible_students.faculty,
eligible_students.department,
eligible_students.degreeName,
eligible_students.cloakIssueDate,
eligible_students.cloakReturnDate,
eligible_students.garlandReturnDate,
eligible_students.convocationName,
student_registrations.status,
surveys.id as "svid"

FROM eligible_students
INNER JOIN student_registrations ON eligible_students.regNum=student_registrations.regNum
LEFT JOIN surveys ON student_registrations.regNum = surveys.regNum;
'))->where('convocationName', '=', $convocationName);
            }
            if ($request->ajax()) {
                return view('eligibleStudents._students_tbody', compact('students'));
            }
            return view('eligibleStudents.index',compact('students','convo'));
        }

        elseif ($request->input('studentRegEligible')=="NotRegistered"){

            if($request->input('faculty')!="All Faculty"){
                $students = collect(DB::select('
SELECT
    student_registrations.id as "sid",
eligible_students.id,
eligible_students.nameWithInitials,
eligible_students.regNum,
eligible_students.indexNum,
eligible_students.faculty,
eligible_students.department,
eligible_students.degreeName,
eligible_students.cloakIssueDate,
eligible_students.cloakReturnDate,
eligible_students.garlandReturnDate,
eligible_students.convocationName,
student_registrations.status

FROM eligible_students
LEFT JOIN student_registrations ON eligible_students.regNum=student_registrations.regNum
WHERE student_registrations.regNum IS NULL
'))->where('faculty', '=', $faculty)
                    ->where('convocationName', '=', $convocationName);
            }else{
                $students = collect(DB::select('
SELECT
    student_registrations.id as "sid",
eligible_students.id,
eligible_students.nameWithInitials,
eligible_students.regNum,
eligible_students.indexNum,
eligible_students.faculty,
eligible_students.department,
eligible_students.degreeName,
eligible_students.cloakIssueDate,
eligible_students.cloakReturnDate,
eligible_students.garlandReturnDate,
eligible_students.convocationName,
student_registrations.status

FROM eligible_students
LEFT JOIN student_registrations ON eligible_students.regNum=student_registrations.regNum
WHERE student_registrations.regNum IS NULL
'))->where('convocationName', '=', $convocationName);
            }
            if ($request->ajax()) {
                return view('eligibleStudents._students_tbody', compact('students'));
            }
            return view('eligibleStudents.index',compact('students','convo'));
        }



        else{
            if($request->input('studentRegEligible')=="Pending"||$request->input('studentRegEligible')=="Reject"||$request->input('studentRegEligible')=="Accept") {

                if($request->input('faculty')!="All Faculty") {
                    $students = collect(DB::select('
        SELECT
        student_registrations.id as "sid",
        eligible_students.id,
        eligible_students.nameWithInitials,
        eligible_students.regNum,
        eligible_students.indexNum,
        eligible_students.faculty,
        eligible_students.department,
        eligible_students.degreeName,
        eligible_students.cloakIssueDate,
        eligible_students.cloakReturnDate,
        eligible_students.garlandReturnDate,
        eligible_students.convocationName,
        student_registrations.status,
        surveys.id as "svid"
        FROM eligible_students
        INNER JOIN student_registrations ON eligible_students.regNum=student_registrations.regNum
        LEFT JOIN surveys ON student_registrations.regNum = surveys.regNum;
'))
                        ->where('status', '=', $studentRegEligible)
                        ->where('faculty', '=', $faculty)
                        ->where('convocationName', '=', $convocationName);
                }
                else{
                    $students = collect(DB::select('
        SELECT
        student_registrations.id as "sid",
        eligible_students.id,
        eligible_students.nameWithInitials,
        eligible_students.regNum,
        eligible_students.indexNum,
        eligible_students.faculty,
        eligible_students.department,
        eligible_students.degreeName,
        eligible_students.cloakIssueDate,
        eligible_students.cloakReturnDate,
        eligible_students.garlandReturnDate,
        eligible_students.convocationName,
        student_registrations.status,
        surveys.id as "svid"
        FROM eligible_students
        INNER JOIN student_registrations ON eligible_students.regNum=student_registrations.regNum
        LEFT JOIN surveys ON student_registrations.regNum = surveys.regNum;
'))
                        ->where('status', '=', $studentRegEligible)
                        ->where('convocationName', '=', $convocationName);
                }


                if ($request->ajax()) {
                    return view('eligibleStudents._students_tbody', compact('students'));
                }
                return view('eligibleStudents.index',compact('students','convo'));

            }
        }
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EligibleStudent  $eligibleStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(EligibleStudent $eligibleStudent)
    {
        $convo = Convocation::all()->pluck('convocation', 'id');
        return view('eligibleStudents.edit',compact('eligibleStudent','convo'));

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EligibleStudent  $eligibleStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EligibleStudent $eligibleStudent)
    {
        $convo = Convocation::all()->pluck('convocation', 'id');
        if($request->input('regNum')) {
            $eligibleStudent->update([
                'nameWithInitials' => $request->input('nameWithInitials'),
//                'fullNameInEnglishBlock' => $request->input('fullNameInEnglishBlock'),
//                'fullNameInSinhala' => $request->input('fullNameInSinhala'),
                'gender' => $request->input('gender'),
//                  'email' => $request->input('email'),
                'degreeName' => $request->input('degreeName'),
                'regNum' => $request->input('regNum'),
                'indexNum' => $request->input('indexNum'),
//                'monthAndYearExamination' => $request->input('monthAndYearExamination'),
                'degreeClass' => $request->input('degreeClass'),
                'faculty' => $request->input('faculty'),
                'department' => $request->input('department'),
                'convocationName' => $convo[$request->input('convocationName')]

            ]);

            return redirect()->route('eligibleStudents.edit',$eligibleStudent->id)
                ->with('success', 'Successfully updated');

        }elseif (($request->input('cloakIssueDate'))){
            $eligibleStudent->update([
                'cloakIssueDate' => $request->input('cloakIssueDate'),
            ]);

            return redirect()->route('eligibleStudents.index')
                ->with('success', 'Successfully updated');
        }
        elseif (($request->input('cloakReturnDate'))){
            $eligibleStudent->update([
                'cloakReturnDate' => $request->input('cloakReturnDate'),
            ]);

            return redirect()->route('eligibleStudents.index')
                ->with('success', 'Successfully updated');
        }
        elseif (($request->input('garlandReturnDate'))){
            $eligibleStudent->update([
                'garlandReturnDate' => $request->input('garlandReturnDate'),
            ]);
            return redirect()->route('eligibleStudents.index')
                ->with('success', 'Successfully updated');
        }

        elseif (($request->input('status'))){
            $eligibleStudent->update([
                'status' => $request->input('status'),
            ]);
            return redirect()->route('eligibleStudents.index')
                ->with('success', 'Successfully updated');
        }

        else{
            $eligibleStudent->update([
                'status'=>'Confirmed',
            ]);
            return redirect()->route('eligibleStd')
                ->with('success', 'Your data successfully confirmed');
//            $studentRegistrations = StudentRegistration::all();
//            $eligibleStudents = EligibleStudent::all();
//            return view('eligibleStudents.index',compact('eligibleStudents','studentRegistrations'));

//            return view('verifyDone');

        }

    }

    public function statusConfirm(Request $request, EligibleStudent $eligibleStudent)
    {
        $eligibleStudent->update([
            'status'=>'Confirmed',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EligibleStudent  $eligibleStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(EligibleStudent $eligibleStudent)
    {
        //
        $eligibleStudent -> delete();
        return redirect()->route('eligibleStudents.index')
            ->with('success','Successfully deleted');
    }

    public function importstudents()
    {
        return view('eligibleStudents.importstudents');
    }
    public function uploadstudents(Request $request)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new StudentsImport, $request->file);

        return redirect()->route('eligibleStudents.index')->with('success', 'User Imported Successfully');
    }

    public function getByEmail(Request $request)
    {
        $studentRegistrations = StudentRegistration::all();
        $eligibleStudents = EligibleStudent::all();
        $student = EligibleStudent::where(
            'email', $request->email)->get();
        return view('checkedData',compact('student','studentRegistrations','eligibleStudents'));

    }


    public function completeEmailVerification(Request $request, EligibleStudent $eligibleStudent)
    {
//        $eligibleStudent->update([
//            'status'=>'Verified',
//        ]);

        $data=new VerifiedEmail();
        $data->email = $request->email;
        $data->save();


//        $studentRegistrations = StudentRegistration::all();
//        $eligibleStudents = EligibleStudent::all();
//        $student = EligibleStudent::where(
//            'email', $request->email)->get();
//        return view('checkedData',compact('student','studentRegistrations','eligibleStudents'));
        return redirect()->route('checkData')
            ->with('success','You already complete the email verification.');
    }



    public function getESByRegNum(Request $request)
    {
        $regNum = trim($request->input('regNum'));

        $students = collect(DB::select('
SELECT
    eligible_students.id,
    student_registrations.id as "sid",
    eligible_students.nameWithInitials,
    eligible_students.regNum,
    eligible_students.indexNum,
    eligible_students.faculty,
    eligible_students.department,
    eligible_students.degreeName,
    eligible_students.cloakIssueDate,
    eligible_students.cloakReturnDate,
    eligible_students.garlandReturnDate,
    eligible_students.convocationName,
    student_registrations.status,
    surveys.id as "svid"
FROM eligible_students
LEFT JOIN student_registrations ON eligible_students.regNum = student_registrations.regNum
LEFT JOIN surveys ON student_registrations.regNum = surveys.regNum
WHERE eligible_students.regNum = ?
        ', [$regNum]));

        if ($request->ajax()) {
            if ($students->isEmpty()) {
                return response()->json(['error' => 'No student found with register number: ' . $regNum], 404);
            }
            return view('eligibleStudents._students_tbody', compact('students'));
        }

        $convo = Convocation::orderBy('convocation', 'asc')->pluck('convocation', 'id');
        return view('eligibleStudents.index', compact('students', 'convo'));
    }

    public function getByRegNum(Request $request)

    {
        $studentRegistrations = StudentRegistration::all();
        $eligibleStudents = EligibleStudent::all();
        $student = EligibleStudent::where(
            'regNum', $request->regNum)->get();
        return view('checkedData',compact('student','studentRegistrations','eligibleStudents'));

    }

    public function emailGet(Request $request, $email){

        echo $email;
    }


}
