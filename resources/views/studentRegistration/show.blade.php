@extends('layouts.app')

@section('content')
    <div class="row" style="margin: 50px">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Registration of {{ $studentRegistration->nameWithInitial }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('eligibleStudents.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row" style="margin: 50px">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Registration Status:</strong>
                {{ $studentRegistration->status }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name with initials:</strong>
                {{ $studentRegistration->nameWithInitial }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Full name in english block letters:</strong>
                {{ $studentRegistration->fullNameInEnglishBlock }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Full Name in Sinhala:</strong>
                {{ $studentRegistration->fullNameInSinhala }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Gender:</strong>
                {{ $studentRegistration->gender }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NIC:</strong>
                {{ $studentRegistration->nic }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Postal Address:</strong>
                {{ $studentRegistration->address }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mobile Number:</strong>
                {{ $studentRegistration->mobileNumber }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $studentRegistration->email }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Faculty:</strong>
                {{ $studentRegistration->faculty }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Department:</strong>
                {{ $studentRegistration->department }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name of the degree to be conferred:</strong>
                {{ $studentRegistration->degreeName }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Register Number:</strong>
                {{ $studentRegistration->regNum }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Index Number:</strong>
                {{ $studentRegistration->indexNum }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Month and year of the Degree Examination:</strong>
                {{ $studentRegistration->monthAndYearExamination }}
            </div>
        </div>

{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Year of the Degree Examination:</strong>--}}
{{--                {{ $studentRegistration->yearExamination }}--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Class:</strong>
                {{ $studentRegistration->degreeClass }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Whether he/she attend the convocation:</strong>
                {{ $studentRegistration->attendance }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Visitor 1 Name:</strong>
                {{ $studentRegistration->nameVisitor1 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Visitor 1 NIC:</strong>
                {{ $studentRegistration->nicVisitor1 }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Visitor 2 Name:</strong>
                {{ $studentRegistration->nameVisitor2 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Visitor 2 NIC:</strong>
                {{ $studentRegistration->nicVisitor2 }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Payment Receipt:</strong>
                {{-- <input required type="file" name="image" class="form-control" placeholder="image or PDF" id="image" accept="image/*,application/pdf" onchange="previewFile()"> --}}
        
                <!-- Image Preview Section -->
                <div id="imagePreview" style="display: none;">
                    {{-- <label>Image Preview:</label> --}}
                    <img id="imgPreview" src="" alt="Image Preview" style="max-width: 50%; max-height: 200px;" />
                </div>
        
                <!-- PDF Preview Section -->
                <div id="pdfPreview" style="display: none;">
                    {{-- <label>PDF Preview:</label> --}}
                    <embed id="pdfEmbed" src="" type="application/pdf" width="50%" height="400px" />
                </div>
        
                <!-- Display existing image or PDF if available -->
                {{-- @if($studentRegistration->image)
                    <div id="existingPreview">
                        @if(strpos($studentRegistration->image, '.pdf') !== false)
                            <label>Existing PDF:</label>
                            <embed src="{{ asset('/images/'.$studentRegistration->image) }}" type="application/pdf" width="100%" height="400px" />
                        @else
                            <strong>Existing Image:</strong>
                            <img width="50%" src="{{ asset('/images/'.$studentRegistration->image) }}" alt="Existing Image" />
                        @endif
                    </div>
                @endif --}}
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
                        previewImage.style.display = 'none';
                        previewPDF.style.display = 'none';
                    }
                }
            }
        
            // If there's an existing file (image or PDF), show it by default on page load
            document.addEventListener('DOMContentLoaded', function() {
                var existingImage = "{{ $studentRegistration->image }}";
                if (existingImage) {
                    var previewImage = document.querySelector('#imagePreview');
                    var previewPDF = document.querySelector('#pdfPreview');
                    var imgPreview = document.querySelector('#imgPreview');
                    var pdfEmbed = document.querySelector('#pdfEmbed');
        
                    if (existingImage.includes('.pdf')) {
                        previewImage.style.display = 'none';
                        previewPDF.style.display = 'block';
                        pdfEmbed.src = "{{ asset('/images/' . $studentRegistration->image) }}";
                    } else {
                        previewImage.style.display = 'block';
                        previewPDF.style.display = 'none';
                        imgPreview.src = "{{ asset('/images/' . $studentRegistration->image) }}";
                    }
                }
            });
        </script>
        

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Signed Date:</strong>
                {{ $studentRegistration->signedDate }}
            </div>
        </div>




        @if(checkPermission(['Admin','EBSC_Applied','EBSC_Geo','EBSC_Social','EBSC_Mana','EBSC_Med','EBSC_Agri','EBSC_Tech','EBSC_GS','EBSC_Computing', 'EBSC_CIKCS']))

        <form id="reviewForm" action="{{ route('studentRegistration.update',$studentRegistration->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin: 60px" class="row">


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
                        <strong>Review Status:</strong>
                        <div>
                            <select name="status" class="form-control" id="frm_duration">
                                <option selected>{{ $studentRegistration->status }}</option>
                                <option value="Pending">Pending</option>
                                <option value="Accept">Accept</option>
                                <option value="Reject">Reject</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div id="divFrmReject" class="form-group form-duration-div" style="display:none">
                    <input value="{{ $studentRegistration->statusMessage }}" name="statusMessage" type='text' class="form-control" />

                </div>


                <input style="display: none" value={{$studentRegistration->email}}  type="text" name="email" class="form-control" placeholder="Email">



                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Reviewed</button>
                </div>
            </div>

        </form>

        {{-- Loading overlay shown during form submission --}}
        <div id="loadingOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; justify-content:center; align-items:center;">
            <div style="text-align:center; color:#fff;">
                <div class="spinner-border text-light" role="status" style="width:3rem; height:3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div style="margin-top:15px; font-size:1.2rem;">Processing your review...</div>
                <div style="margin-top:5px; font-size:0.9rem; opacity:0.8;">Please do not close or refresh this page.</div>
            </div>
        </div>
        @endif
    </div>

    <!-- Include SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#reviewForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to mark this registration as reviewed?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, confirm it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading overlay
                    var overlay = document.getElementById('loadingOverlay');
                    if (overlay) {
                        overlay.style.display = 'flex';
                    }
                    // Disable the Reviewed button to prevent double submission
                    var btn = event.target.querySelector('button[type="submit"]');
                    if (btn) {
                        btn.disabled = true;
                        btn.textContent = 'Please wait...';
                    }
                    event.target.submit(); // Submit the form if confirmed
                }
            });
        });
    });
</script>

@endsection
