@extends('admin.main')
@section('content')
<style>
    @media (min-width:992px) {
    .mdk-drawer-layout .container, .mdk-drawer-layout .container-fluid, .mdk-drawer-layout .container-lg, .mdk-drawer-layout .container-md, .mdk-drawer-layout .container-sm, .mdk-drawer-layout .container-xl {
        max-width: 1440px;
    }
}
.card_color{
    color:black;
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
        display: none!important;
    }
</style>
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">
                        Dashboard
                    </h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Detail

                        </li>

                    </ol>

                </div>
            </div>

        </div>
    </div>

    <!-- Page Content -->

    <div class="container page__container page__container page-section">

        {{-- <a class="" href="{{ url('/export_data') }}"><button class="btn btn-primary ml-auto d-block">Excel</button></a> --}}
        <div class="page-separator">
            <div class="page-separator__text">Detail</div>
        </div>
        <div class="col-md-12">
            
            <a href="{{ route('download.pdf', ['id' => $form_id]) }}" class="btn btn-primary">Download PDF</a>


            <div class="table-responsive">

                <div class="container mt-4">
                    <div class="row align-items-end">

                     @foreach ($details as $item)


                         <div class="col-md-12 mb-4">
                                 <div class="card_color row">
                                     <h5 class="card-title col-6">{{ str_replace('_', ' ', $item->key) }}</h5>
                                    @if($item->value !== null)
                                                 @if ($item->key == 'city')
                                                    @foreach ($city as $cit)
                                                        @if ($item->value ==  $cit->id)
                                                        <p class="card-text col-5">{{ str_replace('_', ' ', $cit->name) }}</p>
                                                        @endif
                                                    @endforeach
                                                @elseif($item->key == 'area')
                                                    @foreach ($area as $ar)
                                                        @if ($item->value ==  $ar->id)
                                                        <p class="card-text col-5">{{ str_replace('_', ' ', $ar->name) }}</p>
                                                        @endif
                                                    @endforeach
                                                @elseif($item->key == 'school')
                                                    @foreach ($school as $sc)
                                                        @if ($item->value ==  $sc->id)
                                                        <p class="card-text col-5">{{ str_replace('_', ' ', $sc->school_name) }}</p>
                                                        @endif

                                                     @endforeach
                                            @else

                                            <p class="card-text col-5">{{ str_replace('_', ' ', $item->value) }}</p>
                                            @endif

                                @else
                                    <p class="card-text col-5">None</p>
                                @endif
                                   </div>
                                   </div>
                    @endforeach
                    </div>
                  </div>
            </div>




        </div>

    </div>
    <div class="row">
        <div class="col-md-3"> 
           
        </div>
        <div class="col-md-6"> 
            <a href="#" class="btn btn-primary" id="psychiatrist">View By psychiatrist</a>
            &nbsp;
            <a href="#" class="btn btn-primary" id="doc">View By Doctor</a>
        </div>
        <div class="col-md-3"> 
           
        </div>
        
    </div>
   
    
    {{-- <button type="button" class="btn btn-primary">View By Doctor</button>
    <button type="button" class="btn btn-primary">View By psychiatrist</button> --}}

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
       $(document).ready(function() {
                $('#psychiatrist').click(function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: "post",
                        url: "{{ url('ViewByphy') }}",
                        data: {
                            _token: "{{ csrf_token() }}", 
                            id:{{$form_id}},            
                        },
                        dataType: "json",
                        beforeSend: function() {
                        
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire({
                                        title: 'Success!',
                                        text: 'Enrollment has been submitted successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        timer: 2000, // Set the timer to 2 seconds (in milliseconds)
                                        timerProgressBar: true, // Show a progress bar during the timer
                                        showConfirmButton: false // Hide the "OK" button
                                    }).then(() => {
                                        //window.location.href = "{{ route('admin.form.index') }}"
                                    });
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                });
                $('#doc').click(function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: "post",
                        url: "{{ url('ViewByDoc') }}",
                        data: {
                            _token: "{{ csrf_token() }}", 
                            id:{{$form_id}},            
                        },
                        dataType: "json",
                        beforeSend: function() {
                        
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire({
                                        title: 'Success!',
                                        text: 'Enrollment has been submitted successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        timer: 2000, // Set the timer to 2 seconds (in milliseconds)
                                        timerProgressBar: true, // Show a progress bar during the timer
                                        showConfirmButton: false // Hide the "OK" button
                                    }).then(() => {
                                        //window.location.href = "{{ route('admin.form.index') }}"
                                    });
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                });
});

</script>
