@extends('layouts.app')


@section('content')
    <?php
//    session_start();
    $id = 0;
    $_SESSION["user_id"] = $id;


    ?>

        <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>



    <div style="margin: 50px">
        @if(checkPermission(['surveyAccess']))
            <div class="col" style="margin-bottom: 10px">
                <div class="pull-center">
                    <a class="btn btn-success" href="{{ route('survey.index') }}">Survey</a>
                </div>
            </div>
        @endif
        @if(checkPermission([ 'Admin','EBSC_Applied','EBSC_Geo','EBSC_Social','EBSC_Mana','EBSC_Med','EBSC_Agri','EBSC_Tech','EBSC_GS','EBSC_Computing','EBSC_CIKCS']))

                <div class="pull-left">
                    <h2 >Eligible Students</h2>
                </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row mb-3 d-flex justify-content-between">
                @if(checkPermission([ 'Admin' ]))
                    <div class="col-12 col-md-2 mb-3 d-flex justify-content-center">
                        <a class="btn btn-dark w-100" href="{{ route('survey.index') }}">Survey</a>
                    </div>
                    <div class="col-12 col-md-2 mb-3 d-flex justify-content-center">
                        <a class="btn btn-dark w-100" href="{{ route('price.index') }}">Convocation Fee</a>
                    </div>
                    <div class="col-12 col-md-2 mb-3 d-flex justify-content-center">
                        <a class="btn btn-dark w-100" href="{{ route('user.index') }}">Users</a>
                    </div>
                    <div class="col-12 col-md-2 mb-3 d-flex justify-content-center">
                        <a class="btn btn-dark w-100" href="{{ route('convocation.index') }}">Convocation</a>
                    </div>
                    <div class="col-12 col-md-2 mb-3 d-flex justify-content-center">
                        <a class="btn btn-dark w-100" href="{{ route('faculty.index') }}">Faculty</a>
                    </div>
                @endif
            
                <div class="col-12 col-md-2 mb-3 d-flex justify-content-center">
                    <a class="btn btn-danger w-100" href="{{ route('report.index') }}">Reports</a>
                </div>
            
                <div class="col-12 col-md-2 mb-3 d-flex justify-content-center">
                    <a class="btn btn-success w-100" href="{{ route('eligibleStudents.create') }}">Add a new student</a>
                </div>
            
                <div class="col-12 col-md-2 mb-3 d-flex justify-content-center">
                    <a class="btn btn-success w-100" href="{{ route('importstudents') }}">Import Data</a>
                </div>
            </div>
            
{{--======================--}}
            <div class="row">
                @if(checkPermission(['Admin']))

                    <form method="GET" action="{{route('export')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-footer">
                            <div class="row">
                            <div class="col-xs-10 col-sm-10 col-md-10" >
                            <div class="form-group">
                                <strong>Convocation:</strong>
                                {{ Form::select('convocationName', $convo, null, ['class' => 'form-control']) }}
                            </div>
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2" style="display: inline-flex;justify-content: center">
                            <button type="submit" class="btn btn-success btn-user float-right mb-3 w-100">Export All Registered Students</button>
                            </div>
                            </div>
                            {{--                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('users.index') }}">Cancel</a>--}}
                        </div>
                    </form>
                @endif
            </div>




{{--            333333333333333--}}


                <div class="row">
                    @if(checkPermission(['Admin']))

                        <form method="GET" action="{{route('exportsurvey')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10" >
                                        <div class="form-group">
                                            <strong>Convocation:</strong>
                                            {{ Form::select('convocationName', $convo, null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2" style="display: inline-flex;justify-content: center">
                                        <button type="submit" class="btn btn-success btn-user float-right mb-3 w-100">Export Survey</button>
                                    </div>
                                </div>
                                {{--                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('users.index') }}">Cancel</a>--}}
                            </div>
                        </form>
                    @endif
                </div>


{{--            33333333--}}

            <div class="row">

                @if(checkPermission(['Admin']))

                <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-xs-10 col-sm-10 col-md-10">
                                <div class="form-group">
                                    <strong>Convocation:</strong>
                                    {{ Form::select('convocationName', $convo, null, ['class' => 'form-control']) }}
                                    <strong>Faculty:</strong>

                                    <select required name="faculty" class="custom-select" id="inputGroupSelect01" >
                                        <option selected>Choose...</option>
                                        {{--                                                <option value="Graduate Studies">Graduate Studies</option>--}}
                                        <option value="Computing">Computing</option>
                                        <option value="Agricultural Sciences">Agricultural Sciences</option>
                                        <option value="Applied Sciences">Applied Sciences</option>
                                        <option value="Geomatics">Geomatics</option>
                                        <option value="Management Studies">Management Studies</option>
                                        <option value="Medicine">Medicine</option>
                                        <option value="Social Sciences & Languages">Social Sciences & Languages</option>
                                        <option value="Technology">Technology</option>
                                        <option value="Sport">Sport</option>
                                        <option value="Graduate Studies">Graduate Studies</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2" style="display: inline-flex;justify-content: center">
                                <button type="submit" class="btn btn-success btn-user float-right mb-3 w-100">Export Registered Students by Faculty</button>
                            </div>
                        </div>

                    </div>
                </form>
                @endif
                    @if(checkPermission(['EBSC_Applied']))
                        <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-footer">
                                <div class="row">
                                    <input style="display: none" required value="Applied Sciences" type="text" name="faculty" class="form-control" >
                                    <div class="form-group">
                                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: inline-flex;justify-content: center">
                                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Export The Registered Students List in Faculty of Applied Sciences</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                    @if(checkPermission(['EBSC_Agri']))
                        <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-footer">
                                <div class="row">
                                    <input style="display: none" required value="Agricultural Sciences" type="text" name="faculty" class="form-control"  >
                                    <div class="form-group">
                                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: inline-flex;justify-content: center">
                                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Export The Registered Students List in Faculty of Agricultural Sciences</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                    @if(checkPermission(['EBSC_Geo']))
                        <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-footer">
                                <div class="row">
                                    <input style="display: none" required value="Geomatics" type="text" name="faculty" class="form-control"  >
                                    <div class="form-group">
                                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: inline-flex;justify-content: center">
                                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Export The Registered Students List in Faculty of Geomatics</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                    @if(checkPermission(['EBSC_Mana']))
                        <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-footer">
                                <div class="row">
                                    <input style="display: none" required value="Management Studies" type="text" name="faculty" class="form-control"  >
                                    <div class="form-group">
                                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: inline-flex;justify-content: center">
                                        <button type="submit"  class="btn btn-success btn-user float-right mb-3">Export The Registered Students List in Faculty of Management Studies</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                    @if(checkPermission(['EBSC_Med']))
                        <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-footer">
                                <div class="row">
                                    <input style="display: none" required value="Medicine" type="text" name="faculty" class="form-control"  >
                                    <div class="form-group">
                                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: inline-flex;justify-content: center">
                                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Export The Registered Students List in Faculty of Medicine</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                    @if(checkPermission(['EBSC_Social']))
                        <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-footer">
                                <div class="row">
                                    <input style="display: none" required value="Social Sciences & Languages" type="text" name="faculty" class="form-control"  >
                                    <div class="form-group">
                                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: inline-flex;justify-content: center">
                                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Export The Registered Students List in Faculty of Social Sciences & Languages</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                    @if(checkPermission(['EBSC_Tech']))
                        <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-footer">
                                <div class="row">
                                    <input style="display: none" required value="Technology" type="text" name="faculty" class="form-control" >
                                    <div class="form-group">
                                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: inline-flex;justify-content: center">
                                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Export The Registered Students List in Faculty of Technology</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                    @if(checkPermission(['EBSC_GS']))
                        <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-footer">
                                <div class="row">
                                    <input style="display: none" required value="Graduate Studies" type="text" name="faculty" class="form-control" >
                                    <div class="form-group">
                                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: inline-flex;justify-content: center">
                                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Export The Registered Students List in Faculty of Graduate Studies</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                    @if(checkPermission(['EBSC_Computing']))
                        <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-footer">
                                <div class="row">
                                    <input style="display: none" required value="Computing" type="text" name="faculty" class="form-control" >
                                    <div class="form-group">
                                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: inline-flex;justify-content: center">
                                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Export The Registered Students List in Faculty of Computing</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                    @if(checkPermission(['EBSC_CIKCS']))
                        <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-footer">
                                <div class="row">
                                    <input style="display: none" required value="Computing" type="text" name="faculty" class="form-control" >
                                    <div class="form-group">
                                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: inline-flex;justify-content: center">
                                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Export The Registered Students List in Indigenous Knowledge & Community Studies</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                    @if(checkPermission(['EBSC_Sport']))
                        <form method="GET" action="{{route('exportbyfaculty')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-footer">
                                <div class="row">
                                    <input style="display: none" required value="Sport" type="text" name="faculty" class="form-control" >
                                    <div class="form-group">
                                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: inline-flex;justify-content: center">
                                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Export The Registered Students List in Faculty of Sport</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
            </div>


        @endif


{{--            <script>--}}

{{--                $(function() {--}}

{{--                    // run on change for the selectbox--}}
{{--                    $( "#frm_duration" ).change(function() {--}}
{{--                        updateDurationDivs();--}}
{{--                    });--}}

{{--                    // handle the updating of the duration divs--}}
{{--                    function updateDurationDivs() {--}}
{{--                        // hide all form-duration-divs--}}
{{--                        $('.form-duration-div').hide();--}}

{{--                        var divKey = $( "#frm_duration option:selected" ).val();--}}
{{--                        $('#divFrm'+divKey).show();--}}
{{--                    }--}}

{{--                    // run at load, for the currently selected div to show up--}}
{{--                    updateDurationDivs();--}}

{{--                });--}}
{{--            </script>--}}


{{-- ===== Search by Register Number ===== --}}
 @if(checkPermission(['Admin','EBSC_Applied','EBSC_Geo','EBSC_Social','EBSC_Mana','EBSC_Med','EBSC_Agri','EBSC_Tech','EBSC_GS','EBSC_Computing','EBSC_CIKCS']))
    <div class="mt-4 w-100 pb-2">
        <div class="card shadow p-4" style="background-color: #E9DDDD;">
            <h4 class="text-center mb-4">Search by Register Number</h4>

            <div id="regNumError" class="alert alert-danger d-none" role="alert"></div>

            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-9">
                    <label for="regNumSearch" class="form-label">Register Number</label>
                    <input type="text" id="regNumSearch" class="form-control"
                           placeholder="e.g. 21CIS0138" autocomplete="off">
                </div>
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="button" id="regNumSearchBtn" class="btn btn-primary w-100">Search</button>
                    <button type="button" id="regNumResetBtn" class="btn btn-outline-secondary w-100">Reset</button>
                </div>
            </div>
        </div>
    </div>
 @endif
{{-- ===== End Search by Register Number ===== --}}

 @if(checkPermission(['Admin','EBSC_Applied','EBSC_Geo','EBSC_Social','EBSC_Mana','EBSC_Med','EBSC_Agri','EBSC_Tech','EBSC_GS','EBSC_Computing','EBSC_CIKCS']))
    <div class=" mt-4 w-100 pb-4">
        <div class="card shadow p-4" style="background-color: #E9DDDD;">
            <h4 class="text-center mb-4">Search Eligible Students</h4>

            <form action="{{ route('getESByFormRequest') }}" id="selectform" method="GET">
                @csrf
                <div class="row g-3">
                    
                    <div class="col-12">
                        <label for="convocationName" class="form-label">Convocation Name</label>
                        {{ Form::select('convocationName', ($convo), null, ['class' => 'form-select']) }}
                    </div>

                    <div class="col-md-6">
                        <label for="studentRegEligible" class="form-label">Registration Status</label>
                        <select required name="studentRegEligible" class="form-select">
                            <option selected value="All">All Eligible Students</option>
                            <option value="Registered">Registered Students</option>
                            <option value="Pending">Registered Students Pending</option>
                            <option value="Reject">Registered Students Rejected</option>
                            <option value="Accept">Registered Students Accepted</option>
                            <option value="NotRegistered">Not Registered Students</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="faculty" class="form-label">Faculty</label>
                        <select required name="faculty" class="form-select">
                            <option value="All Faculty">All Faculty</option>
                            <option value="Computing">Computing</option>
                            <option value="Agricultural Sciences">Agricultural Sciences</option>
                            <option value="Applied Sciences">Applied Sciences</option>
                            <option value="Geomatics">Geomatics</option>
                            <option value="Management Studies">Management Studies</option>
                            <option value="Medicine">Medicine</option>
                            <option value="Social Sciences & Languages">Social Sciences & Languages</option>
                            <option value="Technology">Technology</option>
                            <option value="Sport">Sport</option>
                            <option value="Graduate Studies">Graduate Studies</option>
                            <option value="Indigenous Knowledge & Community Studies">Indigenous Knowledge & Community Studies</option>
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-center gap-3 mt-3">
                        <button type="submit" class="btn btn-primary px-4">Search</button>
                        <button type="button" class="btn btn-outline-secondary px-4" 
                            onclick="document.getElementById('selectform').reset();">
                            Reset
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>




{{--            </div>--}}
            @endif






            <div class="table-responsive">
                <table id="divFrmAll" class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-dark sticky-top">
                        <tr>
                            <th>No</th>
                            @if(checkPermission(['Admin','EBSC_Applied','EBSC_Geo','EBSC_Social','EBSC_Mana','EBSC_Med','EBSC_Agri','EBSC_Tech','EBSC_GS','surveyAccess','EBSC_Computing','EBSC_CIKCS']))
                            <th>Registration Status</th>
                            @endif
                            <th>Name</th>
                            <th>Register Number</th>
                            <th>Index Number</th>
                            @if(checkPermission(['Admin','viceChancellor','EBSC_Applied','EBSC_Geo','EBSC_Social','EBSC_Mana','EBSC_Med','EBSC_Agri','EBSC_Tech','EBSC_GS','surveyAccess','EBSC_Computing','EBSC_CIKCS']))
                            <th>Faculty</th>
                            <th>Department</th>
                            <th>Degree Name</th>
                            <th>Action</th>
                            @endif
                            @if(checkPermission(['mainStoreClark','Admin']))
                            <th>Cloak Issue</th>
                            <th>Cloak Return</th>
                            <th>Garland Return</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="students-tbody">
                        @php $a = 0 @endphp
                        @foreach ($students as $allEligibleStudent)
                        <tr>
                            @if(checkPermission(['Admin','viceChancellor','surveyAccess']))
                            <td>{{ ++$a }}</td>
                            @include('component.allEligibleStudentsTableComponent')
                            @endif
                            @foreach(['EBSC_Applied' => 'Applied Sciences', 'EBSC_Geo' => 'Geomatics', 'EBSC_Social' => 'Social Sciences & Languages', 'EBSC_Mana' => 'Management Studies', 'EBSC_Med' => 'Medicine', 'EBSC_Agri' => 'Agricultural Sciences', 'EBSC_Tech' => 'Technology', 'EBSC_GS' => 'Graduate Studies', 'EBSC_Computing' => 'Computing','EBSC_CIKCS' => 'Indigenous Knowledge & Community Studies'] as $role => $faculty)
                            @if(checkPermission([$role]) && $allEligibleStudent->faculty == $faculty)
                            <td>{{ ++$a }}</td>
                            @include('component.allEligibleStudentsTableComponent')
                            @endif
                            @endforeach
                            @if(checkPermission(['Admin']))
                            <td>
                                <form action="{{ route('eligibleStudents.update',$allEligibleStudent->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="Not Yet" name="cloakIssueDate">
                                    <input type="checkbox" value={{Carbon\Carbon::now()}} name="cloakIssueDate" @if($allEligibleStudent->cloakIssueDate!='Not Yet') checked @endif>
                                    <div>{{ $allEligibleStudent->cloakIssueDate }}</div>
                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('eligibleStudents.update',$allEligibleStudent->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="Not Yet" name="cloakReturnDate">
                                    <input type="checkbox" value={{Carbon\Carbon::now()}} name="cloakReturnDate" @if($allEligibleStudent->cloakReturnDate!='Not Yet') checked @endif>
                                    <div>{{ $allEligibleStudent->cloakReturnDate }}</div>
                                    <button type="submit" class="btn btn-info btn-sm">Update</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('eligibleStudents.update',$allEligibleStudent->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="Not Yet" name="garlandReturnDate">
                                    <input type="checkbox" value={{Carbon\Carbon::now()}} name="garlandReturnDate" @if($allEligibleStudent->garlandReturnDate!='Not Yet') checked @endif>
                                    <div>{{ $allEligibleStudent->garlandReturnDate }}</div>
                                    <button type="submit" class="btn btn-danger btn-sm">Update</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            








<script>
// --- Existing: Search Eligible Students (by filters) ---
document.getElementById('selectform').addEventListener('submit', function (e) {
    e.preventDefault();

    const tbody = document.getElementById('students-tbody');
    const colCount = document.querySelectorAll('#divFrmAll thead th').length;

    // Show loading indicator
    tbody.innerHTML = `<tr><td colspan="${colCount}" class="text-center py-4">
        <div class="spinner-border text-primary" role="status"></div>
        <div class="mt-2 text-muted">Loading students...</div>
    </td></tr>`;

    const params = new URLSearchParams(new FormData(this)).toString();

    fetch('/getESByFormRequest?' + params, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(function (res) {
        if (!res.ok) throw new Error('Server returned ' + res.status);
        return res.text();
    })
    .then(function (html) {
        tbody.innerHTML = html;
    })
    .catch(function (err) {
        tbody.innerHTML = `<tr><td colspan="${colCount}" class="text-center text-danger py-4">
            <strong>Error loading data.</strong> Please try again.
        </td></tr>`;
        console.error('AJAX search error:', err);
    });
});

// --- New: Search by Register Number ---
document.getElementById('regNumSearchBtn').addEventListener('click', function () {
    const regNum  = document.getElementById('regNumSearch').value.trim();
    const errorEl = document.getElementById('regNumError');

    // Reset error state
    errorEl.classList.add('d-none');
    errorEl.textContent = '';

    if (!regNum) {
        errorEl.textContent = 'Please enter a register number before searching.';
        errorEl.classList.remove('d-none');
        return;
    }

    const tbody    = document.getElementById('students-tbody');
    const colCount = document.querySelectorAll('#divFrmAll thead th').length;

    tbody.innerHTML = `<tr><td colspan="${colCount}" class="text-center py-4">
        <div class="spinner-border text-primary" role="status"></div>
        <div class="mt-2 text-muted">Searching...</div>
    </td></tr>`;

    fetch('/getESByRegNum?regNum=' + encodeURIComponent(regNum), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function (res) {
        if (res.status === 404) {
            return res.json().then(function (data) {
                throw { type: 'not_found', message: data.error || 'No student found with that register number.' };
            });
        }
        if (!res.ok) throw { type: 'server', message: 'Server error (' + res.status + '). Please try again.' };
        return res.text();
    })
    .then(function (html) {
        tbody.innerHTML = html;
    })
    .catch(function (err) {
        // Restore empty tbody
        tbody.innerHTML = '';
        if (err && err.type === 'not_found') {
            errorEl.textContent = err.message;
            errorEl.classList.remove('d-none');
        } else {
            errorEl.textContent = (err && err.message) ? err.message : 'An unexpected error occurred.';
            errorEl.classList.remove('d-none');
            console.error('RegNum search error:', err);
        }
    });
});

document.getElementById('regNumResetBtn').addEventListener('click', function () {
    document.getElementById('regNumSearch').value = '';
    document.getElementById('regNumError').classList.add('d-none');
    document.getElementById('regNumError').textContent = '';
});
</script>

@endsection
