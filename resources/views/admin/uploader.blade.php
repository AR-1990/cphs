@extends('admin.main')
@section('content')
    <style>
        @media (min-width:992px) {

            .mdk-drawer-layout .container,
            .mdk-drawer-layout .container-fluid,
            .mdk-drawer-layout .container-lg,
            .mdk-drawer-layout .container-md,
            .mdk-drawer-layout .container-sm,
            .mdk-drawer-layout .container-xl {
                max-width: 1440px;
            }
        }

        .card_color {
            color: black;
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif !important;
            border-bottom: 1px solid grey;

        }

        /* h5{
        color:rgb(26, 36, 172) !important;
        font-size: 25px !important;
        font-family: 'Times New Roman', Times, serif !important;


    } */
        .card_color h5.card-title {
            color: #1c3866;
            font-size: 23px;
        }

        .card_color .card-text {
            margin-left: 10px;
        }

        [dir=ltr] .mdk-drawer-layout .mdk-drawer[data-persistent][data-position=left] {
            display: none;
        }

        .nav.navbar-nav.flex-nowrap.d-flex.mr-16pt.align-items-center {
            display: none !important;
        }
    </style>
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">

                    
                    <h2 class="mb-0">
                        Upload Screening Form
                    </h2>

                    <!-- Display success message if available -->
                 @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}

                        
                        
                        
                    </div>
                @endif
                    <!-- Display success message if available -->
                 @if(session('error'))
                    <div class="alert alert-success">
                        {{ session('error') }}

                        
                        
                        
                    </div>
                @endif

                <!-- Display edit links if available -->
                @if(session('EditLink'))
                    <br>
                    <ul id="edit-links" >
                        @foreach(session('EditLink') as $link)
                            <li><a target="_blank" href="{{ $link['url'] }}" class="btn btn-primary">
                                Click to Edit 
                                &nbsp;&nbsp; <b>{{$link['name']}}</b> &nbsp;&nbsp;
                                  Record </a></li>
                        @endforeach
                    </ul>
                @endif

                <!-- Display edit links if available -->
                @if(session('SchoolNameErrors'))
                    <br>
                    <ul>
                        @foreach(session('SchoolNameErrors') as $link)
                           
                        <li>{{$link}}</li>

                        @endforeach
                    </ul>
                @endif
               
                {{-- @if(session('EditLink'))
                    <br>
                    <ul id="edit-links" >
                        @foreach(session('EditLink') as $link)
                            <li><a target="_blank" href="{{ $link }}" class="btn btn-primary">Edit Record</a></li>
                        @endforeach
                    </ul>
                @endif --}}

                

                <form action="{{ route('upload.csv') }}" method="POST" enctype="multipart/form-data" onsubmit="handleFormSubmit(event)">
                    @csrf
                    <input type="file" name="csv_file" accept=".csv" required>
                    {{-- <button id="submit-btn" type="submit" class="btn btn-primary ml-auto d-block">Upload CSV</button> --}}
                    <button id="submit-btn" type="submit" class="btn btn-primary ml-auto ">Upload CSV</button>
                    <span id="processing-msg" style="display:none;">Processing...</span>
                </form>

                </div>
            </div>

        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    function handleFormSubmit(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Disable the submit button
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.disabled = true;

        // Show the processing message
        const processingMsg = document.getElementById('processing-msg');
        processingMsg.style.display = 'inline';

        // Submit the form programmatically
        event.target.submit();
    }


    // Check if the session contains EditLink
    @if(session('EditLink'))
        // Iterate over each link and open it in a new tab
        $('#edit-links a').each(function() {
            var link = $(this).attr('href');
            console.log("link "+ link);
            // window.open(link, '_blank');
        });
    @endif
});
</script>