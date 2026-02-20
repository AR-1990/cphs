@extends('admin.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.custom_card_btn {
    width: 100%;
    text-align: center;
}


.custom_card_btn .btn {
    background: #1c3866;
    color: #fff;
    width: 100%;
    border-radius: 40px;
    padding: 20px 20px;
    font-size: 21px;
    gap: 10px;
    transition: 0.3s ease;
}
.custom_card_btn .btn:hover{
    background: #E55123!important;
}
.graph{
    padding: 20px;
    
}
.h1{
    text-align: center;
}



</style>

  <script>
// window.onload = function () {

// var chart = new CanvasJS.Chart("chartContainer", {
// 	animationEnabled: true,
// 	theme: "light2", // "light1", "light2", "dark1", "dark2"
// 	title:{
// 		text: "No of Students Graph"
// 	},
// 	axisY: {
// 		title: "Student Count"
// 	},
// 	data: [{        
// 		type: "column",  
// 		showInLegend: true, 
// 		legendMarkerColor: "grey",
// 		legendText: "Nov-23 to Dec-24",
// 		dataPoints: [      
// 			{ y: 100, label: "Nov'23"},
// 			{ y: 100,  label: "Dec'23" },
// 			{ y: 200,  label: "Jan'24" },
// 			{ y: 300,  label: "Feb'24" },
// 			{ y: 400,  label: "Mar'24" },
// 			{ y: 500, label: "Apr'24" },
// 			{ y: 600,  label: "May'24" },
// 			{ y: 700,  label: "June'24" },
// 			{ y: 800,  label: "July'24" },
// 			{ y: 900,  label: "Aug'24" },
// 			{ y: 1000,  label: "Sept'24" },
// 			{ y: 150,  label: "Oct'24" },
// 			{ y: 350,  label: "Nov'24" },
// 			{ y: 450,  label: "Dec'24" }
// 		]
// 	}]
// });
// chart.render();

// }
// document.addEventListener('DOMContentLoaded', function() {
//     // Data
//     var schools = ['School A', 'School B', 'School C', 'School D','School A', 'School B', 'School C', 'School D','School A', 'School B', 'School C', 'School D','School A', 'School B', 'School C', 'School D']; // Add more schools if needed
//     var studentsCount = [50, 100, 150, 172,195, 230, 300, 350,200, 250, 300, 350,200, 250, 300, 350]; // Add corresponding student counts
  

//     // Create a canvas
//     var canvas = document.getElementById('myChart');
//     var ctx = canvas.getContext('2d');

//     // Create the chart
//     var chart = new Chart(ctx, {
//         type: 'bar',
//         data: {
//             labels: schools,
//             datasets: [{
//                 label: 'Number of Students',
//                 data: studentsCount,
//                 backgroundColor: ['rgb(224, 93, 16)','rgb(224, 179, 16)','rgb(219, 117, 107)','rgb(227, 159, 70)','rgb(40, 145, 237)','rgb(210, 141, 227)'],
//                 borderColor: 'rgb(39, 25, 99)',
//                 borderWidth: 3
//             }]
//         },
//         options: {  
//             scales: {
//                 y: {
//                     beginAtZero: true,
//                     ticks: {
//                         stepSize: 50 // Adjust as needed
//                     }
//                 }
//             }
//         }
//     });
// });

// </script>
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>

                    </ol>

                </div>
            </div>

          

        </div>
    </div>
               

    <div class="container page__container">
        <div class="page-section">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="custom_card_btn">
                        {{-- <a href="{{ route('user_form_data') }}" class="btn"> --}}
                        <a href="#"" class="btn">
                        <i class="fas fa-school"></i>
                           My Entries <b> {{$total_entries1}} </b>
                        </a>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="custom_card_btn">
                        <a href="javascript:void(0)" class="btn">
                        <i class="fas fa-map-marker-alt"></i>
                            Locations
                        </a>
                    </div>
                </div> --}}
                {{-- <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="custom_card_btn">
                        <a href="{{ route('admin.user.index') }}" class="btn">
                        <i class="fas fa-users"></i>
                            Users <b> {{$total_users}} </b>
                        </a>
                    </div>
                </div> --}}
                {{-- <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="custom_card_btn">
                        <a href="javascript:void(0)" class="btn">
                        <i class="fas fa-graduation-cap"></i>
                         Students
                        </a>
                    </div>
                </div> --}}
             

            </div>
        </div>
    </div>
    {{-- <div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script> --}}

    {{-- <h1 class="h1">No of Students Graph</h1> --}}
    <body>
        <canvas class="graph" id="myChart" height="500px"></canvas>
        <script src="script.js"></script>
    </body>

@endsection
