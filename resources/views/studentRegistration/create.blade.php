@extends('layouts.app')

@section('content')



    <div class="">
        

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

            @foreach (($eligibleStudents) as $eligibleStudent)

                                   {{-- @if (strtoupper(trim($eligibleStudent->regNum)) === strtoupper(trim(Auth::user()->regNum))) --}}
                @if (strtoupper(trim(str_replace(' ', '', str_replace('/', '', $eligibleStudent->regNum)))) === strtoupper(trim(str_replace(' ', '', str_replace('/', '', Auth::user()->regNum)))))
                    @php
                        $_SESSION["convocationName"]=$eligibleStudent->convocationName;
                    @endphp

                @endif
            @endforeach




        <div style="margin: 60px" class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Registration</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('eligibleStd') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('studentRegistration.store') }}" id="selectform" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        @foreach ($eligibleStudents as $eligibleStudent)

{{--            @if (strtoupper(trim($eligibleStudent->regNum)) === strtoupper(trim(Auth::user()->regNum)))--}}
            @if (strtoupper(trim(str_replace(' ', '', str_replace('/', '', $eligibleStudent->regNum)))) === strtoupper(trim(str_replace(' ', '', str_replace('/', '', Auth::user()->regNum)))))

                @foreach($convocations as $convocation)
                    @if(($convocation->convocation==$eligibleStudent->convocationName)&&($convocation->status=="Closed"))
                        <h2 style="color: #ff0000; font-weight: bold">{{$eligibleStudent->convocationName}} convocation not available</h2>
                    @endif
                    @if(($convocation->convocation==$eligibleStudent->convocationName)&&($convocation->status=="Open"))
                            @foreach($faculties as $faculty)
                                @if(($faculty->faculty==$eligibleStudent->faculty)&&($faculty->status=="Closed"))
                                    <div style="margin: 60px" class="row">
                                        <h2 style="color: #ff0000; font-weight: bold">Registration Closed in Faculty of {{$eligibleStudent->faculty}}</h2>
                                    </div>
                                @endif
                                @if(($faculty->faculty==$eligibleStudent->faculty)&&($faculty->status=="Open"))
                                <style>
                                    .responsive-margin {
                                        margin: 40px;
                                    }

                                    @media (min-width: 768px) {
                                        .responsive-margin {
                                            margin: 60px;
                                        }
                                    }
                                    </style>    
                                <div  class="row responsive-margin">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Name with initials:</strong>
                                                <input readonly value="{{ $eligibleStudent->nameWithInitials }}" required type="text" name="nameWithInitial" class="form-control" placeholder="Name with initials">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Full name in English block letters:</strong>
                                                <input required type="text" name="fullNameInEnglishBlock" class="form-control" placeholder="Full name in English block letters">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Full name in Sinhala:</strong>
                                                <input required type="text" name="fullNameInSinhala" class="form-control" placeholder="Full name in Sinhala">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Gender:</strong>
                                                <input readonly value="{{ $eligibleStudent->gender }}" type="text" name="gender" class="form-control" placeholder="Gender">

                                                {{--                            <select required name="gender" class="custom-select" id="inputGroupSelect01" >--}}
                                                {{--                                <option selected>Choose...</option>--}}
                                                {{--                                <option value="Male">Male</option>--}}
                                                {{--                                <option value="Female">Female</option>--}}
                                                {{--                            </select>--}}
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>NIC Number:</strong>
                                                <input required type="text" name="nic" class="form-control" placeholder="NIC Number">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Postal Address:</strong>
                                                <input required type="text" name="address" class="form-control" placeholder="Postal Address">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Mobile Number:</strong>
                                                <input required type="text" name="mobileNumber" class="form-control" placeholder="Mobile Number">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Email:</strong>
                                                <input required type="text" name="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Faculty:</strong>
                                                <input readonly value="{{ $eligibleStudent->faculty }}" required type="text" name="faculty" class="form-control" placeholder="Faculty">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Department:</strong>
                                                <input readonly value="{{ $eligibleStudent->department }}" required type="text" name="department" class="form-control" placeholder="Department">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Name of the degree to be conferred:</strong>
                                                <input readonly value="{{ $eligibleStudent->degreeName }}" type="text" name="degreeName" class="form-control" placeholder="Name of the degree to be conferred">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Register Number:</strong>
                                                <input readonly value="{{ $eligibleStudent->regNum }}" required type="text" name="regNum" class="form-control" placeholder="Register Number">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Index Number:</strong>
                                                <input readonly value="{{ $eligibleStudent->indexNum }}" required type="text" name="indexNum" class="form-control" placeholder="Index Number">
                                            </div>
                                        </div>
{{--                                        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <strong>Convocation Name:</strong>--}}
{{--                                                <input readonly value="{{ $eligibleStudent->convocationName }}" required type="text" name="convocationName" class="form-control" placeholder="Convocation Name">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}




                                        <script type="text/javascript">
                                            $(function () {
                                                $('#datetimepicker2').datepicker({
                                                    format: "mm/yyyy",
                                                    viewMode: "months",
                                                    minViewMode: "months",
                                                    weekStart: 0,
                                                    calendarWeeks: true,
                                                    autoclose: true,
                                                    todayHighlight: true,
                                                    orientation: "auto",

                                                });
                                            });
                                        </script>


                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Month and Year of the Degree Examination: </strong>
                                                {{--                            <input readonly value="{{ $eligibleStudent->monthAndYearExamination }}" required type="text" name="monthAndYearExamination" class="form-control" placeholder="Month and year of examination">--}}

                                                <div class='input-group date' id='datetimepicker2'>
                                                    <input placeholder="MM/YYYY" required name="monthAndYearExamination" type='text' class="form-control" />
                                                    <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                                                </div>
                                            </div>
                                        </div>

                                        {{--                    <div class="row" style="margin-top: 30px">--}}
                                        {{--                        <div class="col-xs-1 col-sm-1 col-md-1" style="margin-top: 8px">--}}
                                        {{--                            <strong>Month and Year of the Degree Examination: </strong>--}}
                                        {{--                        </div>--}}

                                        {{--                        <div class="col-xs-3 col-sm-3 col-md-3">--}}
                                        {{--                            <div class="form-group">--}}
                                        {{--                                --}}
                                        {{--                            </div>--}}
                                        {{--                        </div>--}}
                                        {{--                    </div>--}}


                                        {{--                    <div class="col-xs-12 col-sm-12 col-md-12">--}}
                                        {{--                        <strong>Month and Year of the Degree Examination:</strong>--}}

                                        {{--                    </div>--}}
                                        {{--                    <div class="col-xs-6 col-sm-6 col-md-6">--}}
                                        {{--                        <div class="form-group">--}}
                                        {{--                            <input required type="text" name="monthExamination" class="form-control" placeholder="MM">--}}
                                        {{--                        </div>--}}
                                        {{--                    </div>--}}
                                        {{--                    <div class="col-xs-6 col-sm-6 col-md-6">--}}
                                        {{--                        <div class="form-group">--}}
                                        {{--                            <input required type="text" name="yearExamination" class="form-control" placeholder="YYYY">--}}
                                        {{--                        </div>--}}
                                        {{--                    </div>--}}

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Degree class:</strong>
                                                <input readonly value="{{ $eligibleStudent->degreeClass }}" required type="text" name="degreeClass" class="form-control" placeholder="Degree Class">

                                                {{--                            <div class="row">--}}
                                                {{--                                <div style="display: inline-flex; justify-content: center; margin-top: 5px;" class="col-xs-12 col-sm-12 col-md-3">--}}
                                                {{--                                    <strong style="margin-right:10px">1st Class:</strong>--}}
                                                {{--                                    <input style="margin-top: 5px" type="radio" class="flat" name="degreeClass" value="1st Class" >--}}
                                                {{--                                </div>--}}
                                                {{--                                <div style="display: inline-flex; justify-content: center; margin-top: 5px;" class="col-xs-12 col-sm-12 col-md-3">--}}
                                                {{--                                    <strong style="margin-right:10px">2nd Upper:</strong>--}}
                                                {{--                                    <input style="margin-top: 5px" type="radio" class="flat" name="degreeClass" value="2nd Upper" >--}}
                                                {{--                                </div>--}}
                                                {{--                                <div style="display: inline-flex; justify-content: center; margin-top: 5px;" class="col-xs-12 col-sm-12 col-md-3">--}}
                                                {{--                                    <strong style="margin-right:10px">2nd Lower:</strong>--}}
                                                {{--                                    <input style="margin-top: 5px" type="radio" class="flat" name="degreeClass" value="2nd Lower" >--}}
                                                {{--                                </div>--}}
                                                {{--                                <div style="display: inline-flex; justify-content: center; margin-top: 5px;" class="col-xs-12 col-sm-12 col-md-3">--}}
                                                {{--                                    <strong style="margin-right:10px">Ordinary Pass:</strong>--}}
                                                {{--                                    <input style="margin-top: 5px" type="radio" class="flat" name="degreeClass" value="Ordinary Pass" >--}}
                                                {{--                                </div>--}}

                                                {{--                            </div>--}}

                                            </div>
                                        </div>

                                        {{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
                                        {{--                <div class="form-group">--}}
                                        {{--                    <strong>Whether you attend the convocation:</strong>--}}

                                        {{--                    <select  id="attend" name="attend" class="custom-select" id="inputGroupSelect01" >--}}
                                        {{--                        <option selected>Choose...</option>--}}
                                        {{--                        <option value="Yes">Yes</option>--}}
                                        {{--                        <option value="No">No</option>--}}
                                        {{--                    </select>--}}
                                        {{--                </div>--}}
                                        {{--            </div>--}}



                                        <script>

                                            $(function() {

                                                // run on change for the selectbox
                                                $( "#frm_duration" ).change(function() {
                                                    updateDurationDivs();
                                                });

                                                // handle the updating of the duration divs
                                                function updateDurationDivs() {
                                                    // hide all form-duration-divs
                                                    $('.form-duration-div').hide();

                                                    var divKey = $( "#frm_duration option:selected" ).val();
                                                    $('#divFrm'+divKey).show();
                                                }

                                                // run at load, for the currently selected div to show up
                                                updateDurationDivs();

                                            });
                                        </script>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Whether you attend the convocation:</strong>
                                                <div>
                                                    <select required name="attendance" class="form-control" id="frm_duration">
                                                        <option ></option>
                                                        <option value="No">No</option>
                                                        <option value="Yes">Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="divFrmYes" class="form-group form-duration-div" style="display:none">
                                            {{--============--}}
                                            <div>
                                                If Yes, Please give the Names and the NIC of two visitors you are intending to accompany:
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4 col-sm-4 col-md-4">

                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <strong>Visitor 1</strong>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <strong>Visitor 2</strong>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <strong>Name:</strong>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" name="nameVisitor1" class="form-control" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" name="nameVisitor2" class="form-control" placeholder="Name">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <strong>NIC Number:</strong>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" name="nicVisitor1" class="form-control" placeholder="NIC">
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" name="nicVisitor2" class="form-control" placeholder="NIC">
                                                    </div>
                                                </div>
                                            </div>
                                            {{--            ==============--}}


                                            {{--                <div class="col-xs-12 col-sm-12 col-md-12">--}}
                                            {{--                    <div class="form-group">--}}
                                            {{--                        <strong>Index Number:</strong>--}}
                                            {{--                        <input type="text" name="indexNum" class="form-control" placeholder="Index Number">--}}
                                            {{--                    </div>--}}
                                            {{--                </div>--}}

                                            {{--            ============--}}
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Payment Receipt: <span style="color: red">(Please upload an image or PDF file. Maximum size: 2MB.)</span></strong>
                                                <input required type="file" name="image" class="form-control" placeholder="image" id="image" onchange="previewFile()">
                                            </div>
                                        
                                            <!-- Image Preview Section -->
                                            <div id="imagePreview" style="display: none;">
                                                <img id="imgPreview" src="" alt="Image Preview" style="max-width: 50%; max-height: 200px;" />
                                            </div>
                                        
                                            <!-- PDF Preview Section -->
                                            <div id="pdfPreview" style="display: none;">
                                                <embed id="pdfEmbed" src="" type="application/pdf" width="50%" height="400px" />
                                            </div>
                                        </div>
                                        
                                        <script>
                                            function previewFile() {
                                                var file = document.querySelector('#image').files[0];
                                                var previewImage = document.querySelector('#imagePreview');
                                                var previewPDF = document.querySelector('#pdfPreview');
                                                var imgPreview = document.querySelector('#imgPreview');
                                                var pdfEmbed = document.querySelector('#pdfEmbed');
                                                
                                                var reader = new FileReader();
                                        
                                                if (file) {
                                                    // Check file size (2MB = 2 * 1024 * 1024 bytes)
                                                    var maxSize = 2 * 1024 * 1024; // 2MB in bytes
                                                    
                                                    if (file.size > maxSize) {
                                                        alert('File size exceeds 2MB. Please select a smaller file.');
                                                        document.querySelector('#image').value = ''; // Clear the file input
                                                        previewImage.style.display = 'none';
                                                        previewPDF.style.display = 'none';
                                                        return; // Exit the function
                                                    }
                                                    
                                                    var fileType = file.type;
                                        
                                                    if (fileType.startsWith('image')) {
                                                        // For image files
                                                        previewImage.style.display = 'block';
                                                        previewPDF.style.display = 'none';
                                                        reader.onloadend = function() {
                                                            imgPreview.src = reader.result;
                                                        };
                                                        reader.readAsDataURL(file);
                                                    } else if (fileType === 'application/pdf') {
                                                        // For PDF files
                                                        previewImage.style.display = 'none';
                                                        previewPDF.style.display = 'block';
                                                        reader.onloadend = function() {
                                                            pdfEmbed.src = reader.result;
                                                        };
                                                        reader.readAsDataURL(file);
                                                    } else {
                                                        alert('Please select only image or PDF files.');
                                                        document.querySelector('#image').value = ''; // Clear the file input
                                                        previewImage.style.display = 'none';
                                                        previewPDF.style.display = 'none';
                                                    }
                                                }
                                            }
                                        
                                            // Hide both previews by default when the page is loaded
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var previewImage = document.querySelector('#imagePreview');
                                                var previewPDF = document.querySelector('#pdfPreview');
                                                
                                                // Hide both previews by default
                                                previewImage.style.display = 'none';
                                                previewPDF.style.display = 'none';
                                            });
                                        </script>
                                        
                                        
                                        
                                        <div class="row">
                                            <div style="display: inline-flex; justify-content: center" class="col-xs-1 col-sm-1 col-md-1">
                                                <input style="margin-top: 14px" required type="checkbox" name="vehicle" value="Bike">
                                            </div>
                                            <div class="col-xs-11 col-sm-11 col-md-11">
                                                <div>
                                                    I do solemnly declare that I shall faithfully observe the statutes, by - laws and regulations and rules of the Sabaragamuwa University of Sri Lanka in so far as they may apply to me and that I shall not make use of the privileges to be presently conferred on me in any manners so as bring the University into disrepute.
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row" style="margin-top: 30px">
                                            <div class="col-xs-1 col-sm-1 col-md-1" style="margin-top: 8px">
                                                <strong>Date: </strong>
                                            </div>

                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <input readonly value="{{Carbon\Carbon::now()->toDateString()}}" type="text" name="signedDate" class="form-control" placeholder="Date">
                                                {{--                            <div class="form-group">--}}
                                                {{--                                <div class='input-group date' id='datetimepicker1'>--}}
                                                {{--                                    <input  value="{{Carbon\Carbon::now()->toDateString()}}" placeholder="MM/DD/YYYY" required name="signedDate" type='text' class="form-control" />--}}
                                                {{--                                    <span class="input-group-addon">--}}
                                                {{--                            <span class="glyphicon glyphicon-calendar"></span>--}}
                                                {{--                        </span>--}}
                                                {{--                                </div>--}}
                                                {{--                            </div>--}}
                                            </div>
                                        </div>






                                        <script type="text/javascript">
                                            $(function () {
                                                $('#datetimepicker1').datepicker({
                                                    format: "mm/dd/yyyy",
                                                    weekStart: 0,
                                                    calendarWeeks: true,
                                                    autoclose: true,
                                                    todayHighlight: true,
                                                    orientation: "auto",

                                                });
                                            });
                                        </script>

                                        <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>




                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <?php
                                            //                        session_start();

                                            //                        echo $_SESSION["regStatus"]
                                            //                        ='Not';

                                            ?>
                                            @if($_SESSION["regStatus"]=='Not')


                                                {{--                        <button type="submit" class="btn btn-primary">Submit</button>--}}
                                            @endif


                                                @php
                                                    $resultSurvey = App\Http\Controllers\SurveyController::checkSurvey(strtoupper(trim(str_replace(' ', '', str_replace('/', '', Auth::user()->regNum)))));
                                                    $SurveyGDocuments = json_decode($resultSurvey, true);
                                                    $SurveyDocumentsCount = count($SurveyGDocuments);


                                                    $resultRegistration = App\Http\Controllers\SurveyController::checkRegistration(strtoupper(trim(str_replace(' ', '', str_replace('/', '', Auth::user()->regNum)))));
                                                    $rGDocuments = json_decode($resultRegistration, true);
                                                    $rGDocumentsCount = count($rGDocuments);

                                                    $facultyFromEligibleStudent = App\Http\Controllers\SurveyController::getFacultyFromEligibleStudent(strtoupper(trim(str_replace(' ', '', str_replace('/', '', Auth::user()->regNum)))));
                                                $data = json_decode($facultyFromEligibleStudent, true);
                                                $keys = array_keys($data);
                                                $key = $keys[0];
                                                $faculty = $data[$key]['faculty'];
                                                @endphp
                                                @if($eligibleStudent->faculty=='Graduate Studies' || $eligibleStudent->faculty=='Indigenous Knowledge & Community Studies' || $eligibleStudent->faculty=="Agricultural Sciences" || $eligibleStudent->faculty=="Management Studies" || $eligibleStudent->faculty=="Social Sciences & Languages" || $eligibleStudent->faculty=="Medicine")
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                @elseif($SurveyDocumentsCount>0 && $rGDocumentsCount==0 && $faculty!="Graduate Studies" && $faculty!="Indigenous Knowledge & Community Studies" && $faculty!="Agricultural Sciences" && $faculty!="Management Studies" && $faculty!="Social Sciences & Languages" && $faculty!="Medicine")
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                @else
                                                    <button type="submit" class="btn btn-primary">Next</button>
                                                @endif


                                        </div>

                                    </div>
                                @endif
                            @endforeach
                    @endif
                @endforeach





            @endif
        @endforeach

    </form>

    {{-- Loading overlay shown during form submission --}}
    <div id="loadingOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; justify-content:center; align-items:center;">
        <div style="text-align:center; color:#fff;">
            <div class="spinner-border text-light" role="status" style="width:3rem; height:3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div style="margin-top:15px; font-size:1.2rem;">Processing your registration...</div>
            <div style="margin-top:5px; font-size:0.9rem; opacity:0.8;">Please do not close or refresh this page.</div>
        </div>
    </div>
    <div style="margin-bottom:50px;margin-top: -30px" class="row">
        <div class="col-xs-11 col-sm-11 col-md-11 text-center">
        </div>
        <div  class="col-xs-1 col-sm-1 col-md-1">
            <button class="btn btn-dark" onclick="document.getElementById('selectform').reset(); document.getElementById('from').value = null; return false;">
                Reset
            </button>
        </div>
    </div>

    <script>
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const fileType = file.type;
        
            // Clear any previous preview
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('pdfPreview').style.display = 'none';
            document.getElementById('imagePreviewImg').src = '';
            document.getElementById('pdfPreviewEmbed').src = '';
        
            if (file) {
                // Image file preview
                if (fileType.startsWith('image')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreviewImg').src = e.target.result;
                        document.getElementById('imagePreview').style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
                // PDF file preview
                else if (fileType === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('pdfPreviewEmbed').src = e.target.result;
                        document.getElementById('pdfPreview').style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert('Please upload a valid image or PDF file.');
                }
            }
        });

        // Form validation function
        function validateForm() {
            var fileInput = document.querySelector('#image');
            var file = fileInput.files[0];
            
            if (file) {
                var maxSize = 2 * 1024 * 1024; // 2MB in bytes
                
                if (file.size > maxSize) {
                    alert('File size exceeds 2MB. Please select a smaller file before submitting.');
                    return false; // Prevent form submission
                }
                
                var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Please select only image (JPEG, PNG, GIF) or PDF files.');
                    return false; // Prevent form submission
                }
            }
            
            // Validation passed — show loading overlay and disable buttons
            var overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.style.display = 'flex';
            }
            // Disable all submit buttons to prevent double submission
            var buttons = document.querySelectorAll('#selectform button[type="submit"]');
            buttons.forEach(function(btn) {
                btn.disabled = true;
                btn.textContent = 'Please wait...';
            });

            return true; // Allow form submission
        }
    </script>
        
@endsection