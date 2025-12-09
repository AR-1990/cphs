<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Document</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @media (min-width: 992px) {

            .mdk-drawer-layout .container,
            .mdk-drawer-layout .container-fluid,
            .mdk-drawer-layout .container-lg,
            .mdk-drawer-layout .container-md,
            .mdk-drawer-layout .container-sm,
            .mdk-drawer-layout .container-xl {
                max-width: 1440px;
            }
        }

        table {
            max-width: 768px;
            margin: 0 auto;
        }

        /* Table layout for the header */
        .header-table {
            width: 100%;
            border-bottom: 1px solid #d86744;
            margin-bottom: 20px;
        }

        .header-table td {
            vertical-align: top;
            padding: 5px;
        }

        .header-table .logo img {
            width: 300px;
            /* Adjust the width of the logo */
        }

        .header-table .contact-info {
            text-align: right;
            font-size: 17px;
            font-weight: 600;
        }

        .header-table .contact-info p {
            color: black;
            margin-bottom: 7px !important;
        }

        .header-table .contact-info p a {
            color: black;
        }

        .card_color {
            color: black;
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif !important;
            border-bottom: 3px solid #d86744;
        }

        .card_color h5.card-title {
            color: #d86744;
            font-size: 25px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .card_color .card-text {
            padding: 20px 10px;
            color: #000;
            font-size: 21px;
            font-weight: 600;
            background: #d867442e;
            margin: 0;
        }

        /* Hiding drawer */
        [dir=ltr] .mdk-drawer-layout .mdk-drawer[data-persistent][data-position=left] {
            display: none;
        }

        .nav.navbar-nav.flex-nowrap.d-flex.mr-16pt.align-items-center {
            display: none !important;
        }

        /* Watermark for the logo */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: -1;
        }

        .watermark img {
            width: 500px;
            /* Adjust the size of the watermark logo */
        }

        .superheading {
            text-align: center;
            font-size: 65px !important;
            font-weight: 700;
            margin: 25px 0px !important;
            color: #d86744 !important;
        }

        p.card-text.col-5.super_heading_text {
            display: none;
        }

        .card_color.row.has-superheading {
            border: 0;
        }

        .container {
            max-width: 98%;
            margin: 2rem 3rem 0;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px 0;
        }

        .col {
            width: 100%;
            flex: 0 1 100%;
            padding: 0 7px;
        }

        .data-table table {
            width: 100%;
            border: none;
        }

        .data-table tr td:first-child {
            font-weight: 400;
            color: #000;
            text-align: left;
            width: 75%;
            white-space: normal;
        }

        .data-table .tableRow td {
            padding: 10px;
            border: 1px solid #d86744;
            font-size: 18px;
            font-weight: 700;
            width: 49%;
            display: inline-block;
        }

        h2 {
            font-size: 50px;
            color: #843f29;
            text-align: center;
            font-weight: 900;
            margin: 0 0 10px;
        }

        .tableCont,
        .tableCont .tableRow {
            /* display: grid; */
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px 20px;
        }

        .tableCont .tableRow {
            display: inline-block;
            width: 49%;
            margin: 0 auto;
        }

        .data-table tr td {
            border: 1px solid #d86744;
            padding: 7px 14px;
            font-size: 18px;
            font-weight: 700;
            text-align: left;
            white-space: wrap;
        }

        .header-table .contact-info p.date {
            color: #843f29;
            font-weight: 900;
        }
    </style>
</head>

<body>

    <!-- Watermark for the logo -->

    <div class="container">
        <!-- Header with logo and contact information -->
        <table class="header-table">
            <tr>
                <td class="logo">
                    <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" alt="Logo">
                </td>
                <td class="contact-info">
                    <p><a href="tel:+92 3278261594">+92 3278261594</a><br>
                        <a href="http://www.bicphs.com">www.bicphs.com</a> <br>
                        159 Siraj-ud-Daulah Rd, Bahadurabad,<br> Khokan CHS, Karachi, Sindh
                    </p>
                    <p class="date">
                        <span>
                            Screening Date:
                        </span>
                        {{ $formattedDate }}
                    </p>
                </td>
            </tr>
        </table>
        {{-- @dd($details)--}}
        <div class="row">
            <div class="col-12">
                @php
                $redTextConditions = [
                'Normal Posture Gait' => 'no',
                'Mental Status' => 'Lethargic',
                'JAUNDICE' => 'yes',
                'ANEMIA' => 'yes',
                'CLUBBING' => 'yes',
                'CYANOSIS' => 'yes',
                'Skin' => ['Rash', 'Allergy', 'Lesion', 'Bruises'],
                'Breath' => 'Bad Breath',
                'Nails' => 'Dirty',
                'lice/Nits' => 'yes',
                'Hair/scalp' => 'Color-faded',
                'Hair Problem' => ['Kinky', 'Brittle', 'Dry'],
                'Scalp' => ['Scaly', 'Dry', 'Moist'],
                'Hair/distribution' => ['Patchy', 'Receding', 'Receding_Hair_Line'],
                'Normal_ocular_alignment' => 'no',
                'Normal_eye_inspection' => 'no',
                'Normal_color_vision' => 'no',
                'Nystagmus' => 'yes',
                'Normal_ears_shape_and_position' => 'no',
                'Ear_examination' => ['Ear wax', 'Canal infection'],
                'Conclusion_of_hearing_test_with_rinner_and_weber' => ['right_ear_conductive_hearing_loss', 'left_ear_conductive_hearing_loss','right_ear_sensorineural_hearing_loss','left_ear_sensorineural_hearing_loss'],
                'External_nasal_examinaton' =>['Deformities', 'Swelling','Redness','Lesions','Nasal Discharge','Crusting'],
                'nasal_patency_test' =>['Obstruction', 'DNS'],
                'GUMS' =>['Infection', 'Bleed'],
                'tonsils' =>'Tonsillitis',
                'Normal_speech_development' =>'no',
                'Any_neck_swelling' =>'yes',
                'LYMPH NODE' =>'abnormal',
                'WRITE CHEST EXAMINATION-NORMAL' =>'yes',
                'Lung_auscultation' =>['Wheezing','Crackles'],
                'Cardiac_auscultation' =>'Murmur',
                'ABDOMEN' =>['Distention','Scar','Mass'],
                'dental_caries' =>'yes',
                'Abdominal_pain' =>'yes',
                'Any_limitation_in_child_range_of_motion' =>'yes',
                'Adams_forward_bend_test' =>'Positive',
                'Any_foot_or_toe_abnormalities' =>['Flat Feet','Varus','Valgus','High Arch','Hammer Toe','Bunion'],
                'Epi_immunization_card' =>'no',
                'ANY KNOWN ALLERGY' =>'Yes',
                'ANY URINARY PROBLEM' =>['Urinary frequency','Urinary urgency','Pain or discomfort during urination','Nocturnal enuresis'],
                'RESTLESS OR OVERACTIVE' =>['PRETTY MUCH','VARY MUCH'],
                'EXCITABLE, IMPULSIVE' =>['PRETTY MUCH','VARY MUCH'],
                'DISTURBS OTHER CHILDREN' =>['PRETTY MUCH','VARY MUCH'],
                'SHORT SPAN' =>['PRETTY MUCH','VARY MUCH'],
                'INATTENTIVE, EASILY DISTRACTED' =>['PRETTY MUCH','VARY MUCH'],
                'CRIES OFTEN AND EASILY' =>['PRETTY MUCH','VARY MUCH'],
                'SPELLINGS' =>['PRETTY MUCH','VARY MUCH'],
                'WRITES DATE ACCURATELY' =>['PRETTY MUCH','VARY MUCH'],
                'DIRECTIONS SENSE' =>['PRETTY MUCH','VARY MUCH'],
                'CRYING SPELLS' =>['PRETTY MUCH','VARY MUCH'],
                ];
                @endphp

                @foreach ($details as $key => $detail)
                <div class="col">
                    <h2>{{ htmlspecialchars($detail['heading']) }}</h2>
                    <div class="data-table">
                        <table class="tableCont">
                            @php
                            $skipCount = 0;
                            @endphp

                            @foreach ($detail as $subKey => $value)
                            @if ($subKey !== 'heading')

                            @if ($skipCount > 0)
                            @php
                            $skipCount--;
                            @endphp
                            @continue
                            @endif

                            {{-- Conditional skipping for specific keys --}}
                            @if ($subKey === 'LYMPH NODE' && ($value === 'normal' || $value === 'Normal'))
                            @php
                            $skipCount = 2;
                            @endphp
                            @endif
                            @if ($subKey === 'Abdominal_pain' && ($value === 'no' || $value === 'No'))
                            @php
                            $skipCount = 1;
                            @endphp
                            @endif
                            @if ($subKey === 'Any_allergies' && ($value === 'no' || $value === 'No'))
                            @php
                            $skipCount = 1;
                            @endphp
                            @endif
                            @if ($subKey === 'ANY MENSTRUAL PROBLEM' && ($value === 'no' || $value === 'No'))
                            @php
                            $skipCount = 1;
                            @endphp
                            @endif
         
                            <tbody>
                                @if (isset($detail['heading']) && (!empty($subKey === 'Assessment')) || $detail['heading'] === 'Dietary Advice'||$detail['heading'] === 'Doctor Comment' || $detail['heading'] === 'Psychological Assessment')
                                {{-- If the heading is Nutritional Assessment, combine both values into one td --}}
                                <tr>
                                    <td colspan="2" style="
                                        @if (isset($redTextConditions[$subKey]))
                                            @if (is_array($redTextConditions[$subKey]) && is_string($value) && in_array($value, $redTextConditions[$subKey]))
                                                color: red;
                                            @elseif (is_string($value) && is_string($redTextConditions[$subKey]) && strtolower($value) === strtolower($redTextConditions[$subKey]))
                                                color: red;
                                            @endif
                                        @endif
                                    ">
                                        <!-- {{ $value === null ? 'N/A' : $value }} -->
                                          <!-- {{ $value === null ? 'N/A' : strtoupper($value) }} -->
                                            <!-- {{ $value === null ? 'N/A' : ucwords($value) }} -->
                                              <!-- {{ $value === null ? 'N/A' : mb_convert_case(mb_strtolower($value, 'UTF-8'), MB_CASE_TITLE, 'UTF-8') }} -->
                                                <!-- {{ $value === null ? 'N/A' : mb_convert_case(mb_strtolower(rtrim($value, ','), 'UTF-8'), MB_CASE_TITLE, 'UTF-8') }} -->
                                                  <!-- {{ $value === null ? 'N/A' : mb_convert_case(mb_strtolower(preg_replace('/\bYes\b.*/i', '', rtrim($value, ',')), 'UTF-8'), MB_CASE_TITLE, 'UTF-8') }} -->
                                                    {{ $value === null ? 'N/A' : mb_convert_case(mb_strtolower(rtrim(preg_replace('/\bYes\b.*/i', '', $value), " ,"), 'UTF-8'), MB_CASE_TITLE, 'UTF-8') }}






                                    </td>
                                </tr>
                                @else
                                {{-- Otherwise, show the default behavior --}}
                                <tr>
                                    <td>{{ str_replace('_', ' ', strtoupper($subKey)) }}</td>
                                    <td style="
                                        @if (isset($redTextConditions[$subKey]))
                                            @if (is_array($redTextConditions[$subKey]) && is_string($value) && in_array($value, $redTextConditions[$subKey]))
                                                color: red;
                                            @elseif (is_string($value) && is_string($redTextConditions[$subKey]) && strtolower($value) === strtolower($redTextConditions[$subKey]))
                                                color: red;
                                            @endif
                                        @endif
                                    ">
                                        <!-- {{ $value === null ? 'N/A' : $value }} -->
                                          <!-- {{ $value === null ? 'N/A' : strtoupper($value) }} -->
                                            <!-- {{ $value === null ? 'N/A' : ucwords($value) }} -->
                                              <!-- {{ $value === null ? 'N/A' : mb_convert_case(mb_strtolower($value, 'UTF-8'), MB_CASE_TITLE, 'UTF-8') }} -->
                                                {{ $value === null ? 'N/A' : mb_convert_case(mb_strtolower(rtrim($value, ','), 'UTF-8'), MB_CASE_TITLE, 'UTF-8') }}




                                    </td>
                                </tr>
                                @endif
                            </tbody>
                            @endif
                            @endforeach

                        </table>
                    </div>
                </div>
                @endforeach



                <!-- @foreach ($details as $key => $detail)
                    <div class="col">
                        <h2>{{ htmlspecialchars($detail['heading']) }}</h2>
                        <div class="data-table">
                            <table class="tableCont">
                                @foreach ($detail as $subKey => $value)
                                    @if ($subKey !== 'heading') 
                                        <tbody>
                                            <tr>
                                                <td>{{ str_replace('_', ' ', $subKey) }}</td>
                                                <td>{{ $value === null ? 'N/A' : $value }}</td>
                                            </tr>
                                        </tbody>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endforeach -->
            </div>
        </div>
    </div>



    <!-- Page Content -->
    {{--<div class="container page__container page__container page-section">--}}
    {{-- <div class="col-md-12">--}}
    {{-- <div class="table-responsive">--}}
    {{-- <div class="container mt-4">--}}
    {{-- <div class="row align-items-end">--}}
    {{-- @foreach ($details as $key => $value)--}}
    {{-- <div class="col-md-12">--}}
    {{-- <div class="card_color row">--}}
    {{-- @if($value !== null && $key == $value)--}}
    {{-- <h5 class="superheading">{{$key}}</h5>--}}
    {{-- @else--}}
    {{-- <!-- <p class="card-text col-5">-</p> -->--}}
    {{-- <h5 class="card-title col-6" --}} {{-- style="text-transform: capitalize;">{{
                                    str_replace('_', ' ', $key) }}</h5>--}}
    {{-- @endif--}}
    {{-- @if($value !== null)--}}
    {{-- @if ($key == 'City')--}}
    {{-- @foreach ($city as $cit)--}}
    {{-- @if ($value == $cit->id)--}}
    {{-- <p class="card-text col-5">{{ str_replace('_', ' ', $cit->name) }}</p>--}}
    {{-- @endif--}}
    {{-- @endforeach--}}
    {{-- @elseif($key == 'Area')--}}
    {{-- @foreach ($area as $ar)--}}
    {{-- @if ($value == $ar->id)--}}
    {{-- <p class="card-text col-5">{{ str_replace('_', ' ', $ar->name) }}</p>--}}
    {{-- @endif--}}
    {{-- @endforeach--}}
    {{-- @elseif($key == 'School')--}}
    {{-- @foreach ($school as $sc)--}}
    {{-- @if ($value == $sc->id)--}}
    {{-- <p class="card-text col-5">{{ str_replace('_', ' ', $sc->school_name) }}</p>--}}
    {{-- @endif--}}
    {{-- @endforeach--}}
    {{-- @else--}}
    {{-- @if($value !== null && $key == $value)--}}

    {{-- @else--}}
    {{-- <p class="card-text col-5">{{ str_replace('_', ' ', $value) }}</p>--}}
    {{-- @endif--}}
    {{-- @endif--}}
    {{-- @else--}}
    {{-- <p class="card-text col-5">-</p>--}}
    {{-- @endif--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- @endforeach--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{--</div>--}}
    <div class="watermark">
        <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" alt="Watermark Logo">
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.card_color').each(function() {
                var titleText = $(this).find('.card-title').text().trim();
                var textContent = $(this).find('.card-text').text().trim();

                // Check if both text values are the same
                if (titleText === textContent) {
                    $(this).find('.card-title').addClass('superheading');
                    $(this).find('.card-text').addClass('super_heading_text');
                }
                if ($(this).find('.superheading').length > 0) {
                    $(this).addClass('has-superheading'); // Add class to card_color if superheading exists
                }
            });
        });
    </script>
</body>

</html>