<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Health Report PDF</title>
    <style>
        @page {
            size: A3 landscape;
            margin: 20mm;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .wrapper {
                display: block;
            }
        }

        html,
        body {
            width: 100%;
            margin: 1rem auto;
            /*margin: 0 auto;*/
            overflow-x: hidden;
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        body {
            max-width: 1440px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* margin-bottom: 2px; */
            font-size: 13px;
            font-weight: normal;
        }

        th,
        td {
            text-align: left;
            vertical-align: top;
            padding: 1px 2px;
            font-size: 13px;
        }

        .heading {
            font-size: 13px;
            font-weight: bold;
            color: #2b8385;
            text-align: center;
        }

        .section-title {
            /* background-color: #f0f0f0; */
            background: #d5efee;
            font-weight: bold;
            padding: 2px 4px;
            border-bottom: 1px solid #ccc;
            height: auto;
            min-height: 20px;
            border-radius: 8px 8px 0 0 !important;
            -webkit-border-radius: 8px 8px 0 0 !important;
            -moz-border-radius: 8px 8px 0 0 !important;
            overflow: visible;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .bordered {
            border: 1px solid #ccc;
        }

        .logo {
            width: 200px;
            image-rendering: crisp-edges;
            -webkit-print-color-adjust: exact;
        }

        .small {
            font-size: 13px;
        }

        .highlight {
            color: #d9534f;
            font-weight: bold;
        }

        .green {
            color: green;
        }

        .red {
            color: red;
        }

        .gray {
            color: #555;
            padding: 10px 0 10px 0;
            text-align: left !important;
        }

        .main-layout-table {
            width: 100%;
            border-collapse: collapse;
            /* margin-bottom: 5px; */
            table-layout: fixed;
        }

        .main-layout-table td {
            width: 50%;
            vertical-align: top;
            padding: 3px;
        }

        /* Ensure all tables within main layout have proper styling */
        .main-layout-table table {
            border-radius: 8px !important;
            -webkit-border-radius: 8px !important;
            -moz-border-radius: 8px !important;
        }

        .main-layout-table tr {
            height: auto;
        }

        .left-wrapper,
        .right-wrapper {
            width: 50%;
            flex-basis: 50%;
            padding: 0;
            vertical-align: top;
        }




        .heading {
            text-align: start;
            margin: 0;
            color: #358b7d;
            font-weight: 700;
            font-size: 13px;
        }

        .main-heading {
            color: #358b7d;
            font-size: 13px;
            font-weight: 700;
            text-align: center;
        }

        .center-heading {
            text-align: center !important;
        }

        table.bordered {
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 5px;
            overflow: hidden;
        }

        table.black-bordered {
            border: 1px solid rgba(0, 0, 0, 0.12);
            border-radius: 8px;
            margin-bottom: 3px;
            overflow: hidden;
        }

        /* Ensure border-radius works in PDF */
        table.bordered,
        table.black-bordered {
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
        }

        .bordered td {
            /* border: 1px solid #ccc; */
            padding: 1px 2px;
            font-weight: 300;
            color: #848989;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Ensure all bordered sections have proper styling */
        .bordered,
        .black-bordered {
            border-radius: 8px !important;
            -webkit-border-radius: 8px !important;
            -moz-border-radius: 8px !important;
        }

        /* Force border-radius on all tables with borders */
        table[class*="bordered"] {
            border-radius: 8px !important;
            -webkit-border-radius: 8px !important;
            -moz-border-radius: 8px !important;
        }

        /* Ensure all section-title elements have proper border-radius */
        .section-title {
            border-radius: 8px 8px 0 0 !important;
            -webkit-border-radius: 8px 8px 0 0 !important;
            -moz-border-radius: 8px 8px 0 0 !important;
        }

        /* Force border-radius on section-title for PDF */
        .section-title,
        .section-title td {
            border-radius: 8px 8px 0 0 !important;
            -webkit-border-radius: 8px 8px 0 0 !important;
            -moz-border-radius: 8px 8px 0 0 !important;
            overflow: hidden;
        }

        /* Specific border-radius for section-title in bordered tables */
        table.bordered .section-title,
        table.black-bordered .section-title {
            border-radius: 8px 8px 0 0 !important;
            -webkit-border-radius: 8px 8px 0 0 !important;
            -moz-border-radius: 8px 8px 0 0 !important;
        }

        /* Ensure border-radius works in DomPDF */
        * {
            -webkit-border-radius: inherit;
            -moz-border-radius: inherit;
        }

        /* Override any inherited border styles for sign-off sections */
        .main-layout-table .black-bordered,
        .main-layout-table table.black-bordered {
            border: 2px solid #000 !important;
            border-radius: 8px !important;
            -webkit-border-radius: 8px !important;
            -moz-border-radius: 8px !important;
        }

        .general-health td {
            background-color: #fff4e6;
        }

        .general-health .center-heading {
            color: #c7795a;
        }

        /* .bordered tr:first-child td:first-child {
            border-top-left-radius: 10px;
        }

        .bordered tr:first-child td:last-child {
            border-top-right-radius: 10px;
            background: #d5efee;
        }

        .bordered tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }

        .bordered tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
        } */

        .wrapper {
            width: 100%;
            margin-bottom: 15px;
        }

        .two-column {
            width: 100%;
            margin-bottom: 15px;
        }

        .two-column-table {
            width: 100%;
            border-collapse: collapse;
            /* margin-bottom: 3px; */
        }

        .two-column-table td {
            width: 50%;
            vertical-align: top;
            padding: 2px;
            overflow: visible;
        }

        /* Ensure sign-off tables have proper width */
        table#health-screening-conducted-by,
        table#rechecked-by,
        table#phsychological-screening-conducted-by,
        table#nutritional-assessment-by {
            width: 100% !important;
            table-layout: fixed;
        }

        .two-column-table table {
            width: 100%;
            margin-bottom: 0;
        }

        #mdcl-history,
        #vitals {
            background: #e9f7f7;
        }

        table#std-profile {
            background: #e9f7f7;
            width: 100%;
        }

        table#anthropometry {
            background-color: #e9f7f7;
        }

        table#dental-assessment {
            background-color: #d8edde;
        }

        table#dental-assessment .section-title {
            background-color: #d8edde;

        }

        table#dental-assessment .section-title .heading {
            color: #31332d;
        }

        table#developmental-screening {
            width: 100%;
            background-color: #fff6ed;
        }

        table#cardio-pulmonary {
            width: 100%;
            background-color: #fff6ed;
        }

        table#cardio-pulmonary .section-title {
            background-color: #fff6ed;
        }

        table#musculoskeletal-examination {
            background-color: #d8edde;
        }

        table#musculoskeletal-examination .section-title {
            background-color: #d8edde;
        }

        table#musculoskeletal-examination .section-title .heading {
            color: #31332d;
        }

        table#dermatological-assessment {
            background-color: #fff6ed;
        }

        table#dermatological-assessment .section-title {
            background-color: #fff6ed;
        }

        table#dermatological-assessment .section-title .heading {
            color: #c77859;
        }

        table#social-emotional-behevioral {
            width: 100%;
        }

        table#std-profile td {
            padding: 2px 6px;
        }


        table#general-health,
        table#general-health .section-title {
            background-color: #fff6ed;
        }

        /* table#general-health .section-title,
        table#developmental-screening .section-title {
            background-color: #fff4e6;
        } */

        table#general-health .section-title .heading,
        table#cardio-pulmonary .section-title .heading {
            color: #c77859;
        }

        table#vision-hearing,
        table#vision-hearing .section-title,
        table#physician-notes-1,
        table#physician-notes-1 .section-title {
            background-color: #e3e4f0;
        }

        table#vision-hearing .section-title .heading,
        table#social-emotional-behevioral .section-title .heading,
        table#autism-screening .section-title .heading,
        table#physician-notes-1 .section-title .heading,
        table#nutritional-assessment .section-title .heading,
        table#nutritional-assessment p {
            color: #30303c;
        }

        table#social-emotional-behevioral,
        table#social-emotional-behevioral .section-title,
        table#autism-screening,
        table#autism-screening .section-title {
            background-color: #ffe9da;
        }

        table#nutritional-assessment,
        table#nutritional-assessment .section-title {
            background-color: #dcecd2;
        }

        table#social-emotional-behevioral p,
        table#autism-screening p {
            color: #ffa98c;
        }

        table#physician-notes-1 p {
            color: #30303c;
        }

        table#health-screening-conducted-by .section-title,
        table#rechecked-by .section-title,
        table#phsychological-screening-conducted-by .section-title,
        table#nutritional-assessment-by .section-title {
            background-color: #004370;
            border-radius: 8px 8px 0 0 !important;
            -webkit-border-radius: 8px 8px 0 0 !important;
            -moz-border-radius: 8px 8px 0 0 !important;
        }

        /* Ensure all sign-off table section titles have proper border-radius */
        table#health-screening-conducted-by .section-title,
        table#rechecked-by .section-title,
        table#phsychological-screening-conducted-by .section-title {
            border-radius: 8px 8px 0 0 !important;
            -webkit-border-radius: 8px 8px 0 0 !important;
            -moz-border-radius: 8px 8px 0 0 !important;
        }

        table#health-screening-conducted-by .section-title .heading,
        table#rechecked-by .section-title .heading,
        table#phsychological-screening-conducted-by .section-title .heading,
        table#nutritional-assessment-by .section-title .heading {
            color: #ffffff;
        }

        /* Light gray color for p tags in specific tables */
        table#nutritional-assessment p,
        table#physician-notes-1 p {
            color: #848989 !important;
            margin: 0;
            padding: 2px 0;
        }

        table#nutritional-assessment .py-10 {
            padding: 10px 0;
        }

        table#health-screening-conducted-by tr,
        table#rechecked-by tr,
        table#phsychological-screening-conducted-by tr,
        table#nutritional-assessment-by tr {
            background-color: #ffffff;
        }


        table#health-screening-conducted-by td,
        table#rechecked-by td,
        table#phsychological-screening-conducted-by td,
        table#nutritional-assessment-by td {
            padding: 1px 2px !important;
            font-size: 13px;
        }

        /* Ensure sign-off tables have proper borders and border-radius */
        table#health-screening-conducted-by,
        table#rechecked-by,
        table#phsychological-screening-conducted-by,
        table#nutritional-assessment-by {
            border: 1px solid rgba(0, 0, 0, 0.12) !important;
            border-radius: 8px !important;
            -webkit-border-radius: 8px !important;
            -moz-border-radius: 8px !important;
            border-collapse: separate !important;
        }

        /* Force black borders on sign-off table cells */
        table#health-screening-conducted-by td,
        table#rechecked-by td,
        table#phsychological-screening-conducted-by td,
        table#nutritional-assessment-by td {
            border: none !important;
        }

        /* Override any conflicting border styles for sign-off tables */
        .black-bordered {
            border: 1px solid rgba(0, 0, 0, 0.12) !important;
            border-radius: 8px !important;
            -webkit-border-radius: 8px !important;
            -moz-border-radius: 8px !important;
        }

        /* Ensure black-bordered class works specifically for sign-off tables */
        table#health-screening-conducted-by.black-bordered,
        table#rechecked-by.black-bordered,
        table#phsychological-screening-conducted-by.black-bordered,
        table#nutritional-assessment-by.black-bordered {
            border: 1px solid rgba(0, 0, 0, 0.12) !important;
            border-collapse: separate !important;
        }

        table#health-screening-conducted-by td strong,
        table#rechecked-by td strong,
        table#phsychological-screening-conducted-by td strong,
        table#nutritional-assessment-by td strong {
            font-size: 13px;
        }

        #std-profile tr td:nth-child(2),
        #std-profile tr td:nth-child(4) {
            width: 45%;
            word-wrap: break-word;
        }

        #std-profile tr td:nth-child(1),
        #std-profile tr td:nth-child(3) {
            width: 15%;
            white-space: nowrap;
        }

        .bordered td {
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 200px;
        }

        .section-title {
            height: auto;
            min-height: 40px;
        }

        .section-title .heading {
            text-align: start;
            margin: 2px 0;
            padding: 0;
            font-size: 13px;
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .two-column-table tr {
            height: auto;
        }

        .two-column-table td {
            height: auto;
            min-height: 100px;
        }

        .main-layout-table td {
            width: 50%;
            vertical-align: top;
            padding: 3px;
        }

        /* Cover Table Start */

        .cover-table__left,
        .main-layout-table .left-wrapper {
            padding-right: 2rem;
        }

        .cover-table__right,
        .main-layout-table .right-wrapper {
            padding-left: 2rem;
        }

        .cover-table__left,
        .cover-table__right {
            width: 50%;
            vertical-align: top;
        }

        .cover-table__leftBox {
            margin-top: 10px;
        }

        .cover-table p {
            margin: 0.75rem 0;
        }

        .cover-table__leftBox p {
            color: #5b595b;
            line-height: 1.5;
        }

        .cover-table__leftBox-icon img {
            width: 20px;
            vertical-align: middle;
            margin-right: 1rem;
        }

        .top-logo {
            width: 200px;
            /* height: 100px; */
        }

        .school-logo {
            max-width: 100%;
            height: 80px;
        }

        .cover-table__rightBox {
            text-align: center;
        }

        /* .cover-img {
            width: 100%;
            height: 300px;
        } */

        .textCover-img {
            width: 100%;
        }

        .box-logo {
            width: 100%;
            height: 60px;
        }

        table#general-health tr td {
            width: max-content;
        }

        .box-height1 {
            height: 400px;
        }

        .box-height2 {
            height: 260px;
        }

        .box-height3 {
            height: 180px;
        }

        .box-height4 {
            height: 210px;
        }

        table#vitals {
            height: 125px;
        }

        table#anthropometry {
            height: 125px;
        }

        table#dental-assessment {
            height: 105px;
        }

        table#musculoskeletal-examination {
            height: 223px;
        }

        /* Cover Table End */
    </style>
</head>

<body>

    <table class="cover-table">
        <tr>
            <td class="cover-table__left">

                <table class="cover-table__leftHead">
                    <tr>
                        <td>
                            <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" alt="Logo" class="top-logo" />
                        </td>
                        <td style="text-align: right;">
                            <img src="{{ asset('admin/images/urdu-logo.png') }}" alt="Logo" class="top-logo" />
                        </td>
                    </tr>
                </table>

                <table class="cover-table__leftBox box-height1"
                    style="background: #e9e8e7; border-radius: 10px; padding: 20px; table-layout: fixed;">
                    <tr>
                        <td style="text-align: center;">
                            <p>
                                <strong>
                                    Our health report is based on routine screenings conducted at school and is reviewed
                                    by a team of specialists, including doctors, psychologists, and nutritionists.
                                </strong>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <p><strong>Each report includes:</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <strong>
                                    Vision, Hearing & Dental Assessments
                                </strong>
                                <br>
                                Early detection of issues that could affect concentration, learning, and participation
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <strong>
                                    Growth & Nutrition Analysis
                                </strong>
                                <br>
                                BMI tracking, dietary recommendations, and expert guidance for healthy development.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <strong>
                                    Behavioral & Psychological Insights
                                </strong>
                                <br>
                                Identification of early signs of emotional or learning challenges, helping parents and
                                teachers intervene early.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <strong>
                                    Actionable Recommendations Personalized
                                </strong>
                                <br>
                                Advice written by specialists
                                <br>
                                (doctors, psychologists, and nutritionists) with follow-up steps tailored to each
                            </p>
                        </td>
                    </tr>
                </table>

                <table class="cover-table__leftBox box-height2"
                    style="background: #fdd0a5; border-radius: 10px; padding: 20px; table-layout: fixed;">
                    <tr>
                        <td style="text-align: center;" colspan="3">
                            <p>
                                <strong>
                                    Internationally Aligned Health Screening Standards for Schools
                                </strong>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p>
                                Our Health assessments follow evidence based protocols aligned with international best
                                practices, including guidelines from the World Health Organization (WHO) and the
                                American Academy of Pediatrics (AAP). These standards help ensure a high level of care
                                in monitoring student well-being.
                            </p>
                        </td>
                    </tr>
                    <tr class="cover-table__leftBoxImgs">
                        <td>
                            <img src="{{ asset('admin/images/box-logo1.png') }}" alt="Logo" class="box-logo" />
                        </td>
                        <td>
                            <img src="{{ asset('admin/images/box-logo2.png') }}" alt="Logo" class="box-logo" />
                        </td>
                        <td>
                            <img src="{{ asset('admin/images/box-logo3.png') }}" alt="Logo" class="box-logo" />
                        </td>
                    </tr>
                </table>

                <table class="cover-table__leftBox" style="padding: 20px; table-layout: fixed;">
                    <tr>
                        <td>
                            <p style="color: #000; font-size: 18px;">
                                <strong>
                                    Contact Us:
                                </strong>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="cover-table__leftBox-icon">
                                <img src="{{ asset('admin/images/table-icon1.png') }}" alt="image">
                                +92 327-8261594
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="cover-table__leftBox-icon">
                                <img src="{{ asset('admin/images/table-icon2.png') }}" alt="image">
                                www.bicphs.com
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="cover-table__leftBox-icon">
                                <img src="{{ asset('admin/images/table-icon3.png') }}" alt="image">
                                BICPHS, Vital Foakh Tower, Main Shahrah e Faisal, Karachi.
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
            <td class="cover-table__right">

                <table class="cover-table__rightHead">
                    <tr>
                        <td>
                            <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" alt="Logo" class="top-logo" />
                        </td>
                        <td style="text-align: right;">
                            <img src="{{ asset($school_details->logo_path) }}" alt="Logo" class="school-logo" />
                        </td>
                    </tr>
                </table>

                <div class="cover-table__rightBox">
                    <img src="{{ asset('admin/images/pdf-cover-img2.jpeg') }}" alt="Logo" class="cover-img" />
                    <img src="{{ asset('admin/images/text-cover-img.png') }}" alt="Logo" class="textCover-img" />
                </div>

            </td>
        </tr>
    </table>

    <!-- Main content layout -->
    <table class="main-layout-table" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td class="left-wrapper" style="width: 50%; vertical-align: top;">

                <table>
                    <tr>
                        <td>
                            <img src="https://cphs.biopharmainfo.net/admin/images/bicphs_logo_new.png" alt="Logo"
                                class="logo" />
                        </td>
                        <td>
                            <div class="main-heading">
                                <h2>COMPREHENSIVE STUDENT
                                    HEALTH REPORT</h2>
                            </div>
                        </td>
                    </tr>
                </table>

                <table class="bordered" id="std-profile">
                    <tr class="section-title">
                        <td colspan="12">
                            <p class="heading center-heading">STUDENT PROFILE</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Full Name:</td>
                        <td>{{ $details['Bio Data']['Name'] ?? '-' }}</td>
                        <td>System ID:</td>
                        <td>{{ $details['Bio Data']['System ID'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Guardian:</td>
                        <td>{{ $details['Bio Data']['Guardian Name'] ?? '-' }}</td>
                        <td>Screening Date:</td>
                        <td>{{ $formattedDate }}</td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td>{{ $details['Bio Data']['Gender'] ?? '-' }}</td>
                        <!-- <td>Contact:</td>
                    <td>0327-XXXXXXX</td> -->
                    </tr>
                    <tr>
                        <td>DOB:</td>
                        <td>{{ $details['Bio Data']['Date of Birth'] ?? '-' }}</td>
                        <td>Contact Information:</td>
                        <!-- <td>ER Contact #: 0327-XXXXXXX</td> -->
                        <!-- <td>Address:</td>
                    <td>ABC Building & XYZ Road, Karachi</td> -->
                    </tr>
                    <tr>
                        <td>Age:</td>
                        <!-- <td>{{ $details['Bio Data']['Age'] ?? '-' }}</td> -->
                        @php
                        $dob = $details['Bio Data']['Date of Birth'] ?? null;

                        if ($dob) {
                        $dobDate = \Carbon\Carbon::parse($dob);
                        $now = \Carbon\Carbon::now();
                        $years = $dobDate->diffInYears($now);
                        $months = $dobDate->copy()->addYears($years)->diffInMonths($now);
                        $age = $years . '.' . $months;
                        } else {
                        $age = '-';
                        }
                        @endphp

                        <td>{{ $age }}</td>
                        <td>ER Contact #:</td>
                        <td>{{ $details['Bio Data']['Emergency Contact'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>GR #:</td>
                        <td>{{ $details['Bio Data']['GR #'] ?? '-' }}</td>
                        <td>Address:</td>
                        <td>
                                               @php
use Illuminate\Support\Str;
@endphp      
                        {{ Str::limit($details['Bio Data']['Address'] ?? '-', 16, '..') }}</td>

                    </tr>
                    <tr>
                        <td>Class/Section:</td>
                        <td>{{ $details['Bio Data']['class'] ?? '-' }}/{{ $details['Bio Data']['class_section'] ?? '-' }}
                        </td>
                        <td>Area / City:</td>
                        <td>
              
                        {{ Str::limit($details['Bio Data']['Area'] ?? '-', 16, '..') }} / {{ $details['Bio Data']['City'] ?? '-' }}</td>
                    </tr>
                </table>

                <table class="two-column-table">
                    <tr>
                        <td>
                            <table class="bordered" id="mdcl-history">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">MEDICAL HISTORY</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Any Known Med Condition: </td>
                                    <!-- <td>{{ $details['Bio Data']['ANY KNOWN MEDICAL CONDITION'] ?? '-' }}</td> -->
                                    <td>{{ isset($details['Bio Data']['ANY KNOWN MEDICAL CONDITION']) ? ucwords(strtolower($details['Bio Data']['ANY KNOWN MEDICAL CONDITION'])) : '-' }}
                                    </td>

                                </tr>
                                <tr>
                                    <td>Blood Group:</td>
                                    <td>{{ $details['Bio Data']['Blood Group'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Known Allergy:</td>
                                    <td>{{ $details['Miscellaneous']['ANY KNOWN ALLERGY'] ?? '-' }}</td>
                                </tr>
                                <!-- <tr>
                                    <td>Lead Exposure Risk:</td>
                                    <td>{{ $details['development']['Question_No_48_Frequently_put_things_in_mouth'] ?? '-' }}
                                    </td>
                                </tr> -->
                                <tr>
                                    <td>Vaccination Status:</td>
                                    <td>
                                        @php
                                        $vaccination = $details['Vaccination'] ?? [];
                                        $vaccinated = (!empty($vaccination['BCG_1_dose'])
                                        || !empty($vaccination['OPV_4_dose'])
                                        || !empty($vaccination['Pentavalent_vaccine_DTP'])
                                        || !empty($vaccination['Rota'])
                                        || !empty($vaccination['Measles']));
                                        @endphp
                                        {{ $vaccinated ? 'Vaccinated' : 'Not Vaccinated' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="bordered" id="vitals">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">VITALS</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Temperature: </td>
                                    <td> {{ $details['Vitals/BMI']['Temperature'] ?? '-' }} F </td>
                                </tr>
                                <tr>
                                    <td>Systolic BP:</td>
                                    <td>{{ $details['Vitals/BMI']['Systolic BP'] ?? '-' }} mmHg</td>
                                </tr>
                                <tr>
                                    <td>Diastolic BP:</td>
                                    <td> {{ $details['Vitals/BMI']['Diastolic BP'] ?? '-' }} mHg</td>
                                </tr>
                                <tr>
                                    <td>Pulse:</td>
                                    <td> {{ $details['Vitals/BMI']['Pulse'] ?? '-' }} bpm</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table class="two-column-table">
                    <tr>
                        <td>
                            <table class="bordered" id="anthropometry">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">ANTHROPOMETRY</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Height: </td>
                                    <td> {{ $details['Vitals/BMI']['Height'] ?? '-' }} cm </td>
                                </tr>
                                <tr>
                                    <td>Weight:</td>
                                    <td> {{ $details['Vitals/BMI']['Weight'] ?? '-' }} kg</td>
                                </tr>
                                <tr>
                                    <td>BMI:</td>
                                    <td> {{ $details['Vitals/BMI']['BMI'] ?? '-' }} kg/m2</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="bordered" id="dermatological-assessment">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">DERMATOLOGICAL ASSESSMENT</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Skin:</td>
                                    <td>{{ $details['General Appearance']['Skin'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Hair/ Scalp:</td>
                                    <td> {{ $details['Head and Neck examination']['Hair/scalp'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Hair Problem:</td>
                                    <td>{{ $details['Head and Neck examination']['Hair Problem'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Scalp:</td>
                                    <td>{{ $details['Head and Neck examination']['Scalp'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Hair/ Distribution: </td>
                                    <td>{{ $details['Head and Neck examination']['Hair/distribution'] ?? '-' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table class="two-column-table">
                    <tr>
                        <td>
                            <table class="bordered" id="dental-assessment">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">DENTAL ASSESSMENT</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gums: </td>
                                    <td>{{ $details['Dental Examination']['GUMS'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Dental Caries:</td>
                                    <td>{{ $details['Dental Examination']['dental_caries'] ?? '-' }}</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="bordered" id="cardio-pulmonary">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">CARDIO PULMONARY & ABDOMEN</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lung Auscultation:</td>
                                    <td>{{ $details['Chest']['Lung_Auscultation'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Cardiac Auscultation:</td>
                                    <td>{{ $details['Chest']['Cardiac_auscultation'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Abdomen</td>
                                    <td>{{ $details['Abdomen']['ABDOMEN'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Abdominal Pain</td>
                                    <td>{{ $details['Abdomen']['Abdominal_pain'] ?? '-' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table class="two-column-table">
                    <tr>
                        <td>
                            <table class="bordered" id="musculoskeletal-examination">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">MUSCULOSKELETAL EXAMINATION</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Any Limitation in Child Range of Motion: </td>
                                    <td>{{ $details['Musculoskeletal']['Any_limitation_in_child_range_of_motion'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Adam Forward Bend Test:</td>
                                    <td>{{ $details['Musculoskeletal']['Adams_forward_bend_test'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Any Foot or Toe Abnormalities:</td>
                                    <td>{{ $details['Musculoskeletal']['Any_foot_or_toe_abnormalities'] ?? '-' }}</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="bordered" id="vision-hearing">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">VISION & HEARING ASSESSMENT</p>
                                    </td>
                                </tr>
                                <tr>
                                   @php
                                        $right = $details['Eye']['Visual_acuity_using_snellens_chart'] ?? '-';
                                        $left = $details['Eye']['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] ?? '-';

                                        // '-' ke baad sab remove
                                        $right = explode('-', $right)[0];
                                        $left = explode('-', $left)[0];
                                    @endphp
                                    <td>Visual Acuity:</td>
                                    <td>R {{ trim($right) }}</td>
                                    <td>L {{ trim($left) }}</td>
                                </tr>
                                <tr>
                                    <td>Normal Ocular Alignment:</td>
                                    <td>{{ $details['Eye']['Normal_ocular_alignment'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Normal Eye Inspection:</td>
                                    <td>{{ $details['Eye']['Normal_eye_inspection'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Normal Color Vision:</td>
                                    <td>{{ $details['Eye']['Normal_color_vision'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Nystagmus:</td>
                                    <td>{{ $details['Eye']['Nystagmus'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Ear Examination:</td>
                                    <td>{{ $details['Ears']['Ear_examination'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Hearing Test:</td>
                                    <td>{{ !empty($details['Ears']['Conclusion_of_hearing_test_with_rinne_and_weber']) ? str_replace('_', ' ', $details['Ears']['Conclusion_of_hearing_test_with_rinne_and_weber']) : '-' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table class="bordered box-height3" id="general-health" style="">
                    <tr class="section-title">
                        <td colspan="12">
                            <p class="heading">GENERAL HEALTH & HYGIENE</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Normal Posture/Gait:</td>
                        <td>{{ $details['General Appearance']['Normal Posture Gait'] ?? '-' }}</td>
                        <td>Mental Status:</td>
                        <td>{{ $details['General Appearance']['Mental Status'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Jaundice:</td>
                        <td>{{ isset($details['General Appearance']['JAUNDICE']) ? ucfirst(strtolower($details['General Appearance']['JAUNDICE'])) : '-' }}
                        </td>

                        <td>Anemia:</td>
                        <td>{{ $details['General Appearance']['ANEMIA'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Clubbing:</td>
                        <td>{{ $details['General Appearance']['CLUBBING'] ?? '-' }}</td>
                        <td>Cyanosis:</td>
                        <td>{{ $details['General Appearance']['CYANOSIS'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Breath:</td>
                        <td>{{ $details['General Appearance']['Breath'] ?? '-' }}</td>
                        <td>Nails:</td>
                        <td>{{ $details['Inspect Hygiene']['Nails'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Lice Nits:</td>
                        <td>{{ $details['Inspect Hygiene']['lice/Nits'] ?? '-' }}</td>
                        <td>Tonsils:</td>
                        <td>{{ $details['Throat']['tonsils'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Any Neck Swelling:</td>
                        <td>{{ $details['Throat']['Any_neck_swelling'] ?? '-' }}</td>
                        <td>Lymph Node:</td>
                        <td>{{ $details['Throat']['LYMPH NODE'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>External Nasal Examination:</td>
                        <td>{{ $details['Nose']['External_nasal_examinaton'] ?? '-' }}</td>
                        <td>Nasal Patency Test:</td>
                        <td>{{ $details['Nose']['nasal_patency_test'] ?? '-' }}</td>
                    </tr>
                </table>

            </td>
            <td class="right-wrapper">
                <table>
                    <tr>
                        <td>
                            <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" alt="Logo" class="logo" />
                        </td>
                        <td>
                            <div class="main-heading">
                                <h2>
                                    PERSONALIZED
                                    <br>
                                    CLINICAL INSIGHT
                                </h2>
                            </div>
                        </td>
                    </tr>
                </table>

                <table class="bordered box-height4" id="autism-screening">
                    <tr class="section-title">
                        <td colspan="12">
                            <p class="heading">PSYCHOLOGICAL ASSESSMENT</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12">
                            <p>
                                @php
                                $psychComment = $details['Psychological']['Psychologist_Comment'] ?? '-';

                                // Pattern for all concern phrases (case-insensitive)
                                $blockedPattern =
                                '/\b(?:moderate[\s-]*concern(?:s)?|mild[\s-]*concern(?:s)?|high[\s-]*concern(?:s)?)\b/i';

                                // Pattern to remove prefixes like Internalizing -, Externalizing -, Attention -
                                $removePrefixPattern = '/\b(?:Internalizing|Externalizing|Attention)\s*-\s*/i';

                                // Function to clean comment text
                                $cleanComment = function ($comment) use ($blockedPattern, $removePrefixPattern) {
                                if ($comment === '-' || !$comment) return '-';

                                // Remove unwanted prefixes
                                $comment = preg_replace($removePrefixPattern, '', $comment);

                                // Remove concern phrases
                                $cleaned = preg_replace($blockedPattern, '', $comment);

                                // Remove trailing hyphens or extra spaces
                                $cleaned = preg_replace('/[\s-]+$/', '', $cleaned);
                                $cleaned = trim(preg_replace('/\s+/', ' ', $cleaned));

                                return $cleaned === '' ? '-' : $cleaned;
                                };

                                // ✅ Call the function here
                                $cleaned = $cleanComment($psychComment);
                                @endphp

                                {{ $cleaned }}

                                <!-- {{ $details['Psychological']['Psychologist_Comment'] ?? '-' }} -->
                            </p>
                        </td>
                    </tr>
                </table>

                <table class="bordered box-height4" id="nutritional-assessment">
                    <tr class="section-title">
                        <td colspan="12">
                            <p class="heading">NUTRITIONIST REVIEW</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12">
                            <p>
                                {{ $details['Nutritionist']['Assessment'] ?? '-' }}
                                {{ $details['DIETARY ADVICE']['advice'] ?? '-' }}
                            </p>
                        </td>
                    </tr>
                </table>

                <table class="bordered box-height4" id="physician-notes-1">
                    <tr class="section-title">
                        <td colspan="12">
                            <p class="heading">PHYSICIAN NOTES</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12">
                            <p>
                                {{ $details['DOCTOR COMMENT']['doctor_comment'] ?? '-' }}
                            </p>
                        </td>
                    </tr>
                </table>

                <table class="two-column-table">
                    <tr>
                        <td>
                            <table class="black-bordered" id="health-screening-conducted-by">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">HEALTH SCREENING CONDUCTED BY</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>{{$school_details->health_screening_conducted_by_name}}</strong></td>
                                </tr>
                                <tr>
                                    <td>{{$school_details->health_screening_conducted_by_designation}}</td>
                                </tr>
                                <tr>
                                    <td>{{$school_details->health_screening_conducted_by_qualification}}</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="black-bordered" id="rechecked-by">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">RECHECKED BY</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>{{$school_details->rechecked_by_name}}</strong></td>
                                </tr>
                                <tr>
                                    <td>{{$school_details->rechecked_by_designation}}</td>
                                </tr>
                                <tr>
                                    <td>{{$school_details->rechecked_by_qualification}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table class="two-column-table">
                    <tr>
                        <td>
                            <table class="black-bordered" id="phsychological-screening-conducted-by">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">PSYCHOLOGICAL SCREENING REVIEWED BY </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>{{$school_details->psychological_screening_reviewed_by_name}}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{$school_details->psychological_screening_reviewed_by_designation}}</td>
                                </tr>
                                <tr>
                                    <td>{{$school_details->psychological_screening_reviewed_by_qualification}}</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="black-bordered" id="nutritional-assessment-by">
                                <tr class="section-title">
                                    <td colspan="12">
                                        <p class="heading">NUTRITIONAL ASSESSMENT REVIEWED BY</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>{{$school_details->nutritional_assessment_reviewed_by_name}}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{$school_details->nutritional_assessment_reviewed_by_designation}}</td>
                                </tr>
                                <tr>
                                    <td>{{$school_details->nutritional_assessment_reviewed_by_qualification}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table style="width: 100%; border-collapse: collapse; margin-top: 0;">
                    <tr>
                        <td style="width: 100%; text-align: right;">
                            <div class="gray small" style="text-align: right; padding-right: 0 !important;">
                                <strong>Please Note:</strong> This health screening report is based on information
                                provided by your child at the time of screening and is not a substitute for a full
                                medical examination. While efforts have been made to ensure accuracy, we recommend
                                consulting a healthcare professional for any medical concerns. This report is for
                                educational purposes and to support student well-being at school.
                            </div>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

    <!--<table style="width: 100%; border-collapse: collapse;">-->
    <!--    <tr>-->
    <!--        <td style="width: 50%;"></td>-->
    <!--        <td style="width: 50%; text-align: right;">-->
    <!--            <div class="gray small" style="text-align: right; padding-right: 0 !important;">-->
    <!--                <strong>Please Note:</strong> This health screening report is based on information provided by your child at the time of screening and is not a substitute for a full medical examination. While efforts have been made to ensure accuracy, we recommend consulting a healthcare professional for any medical concerns. This report is for educational purposes and to support student well-being at school.-->
    <!--            </div>-->
    <!--        </td>-->
    <!--    </tr>-->
    <!--</table>-->


</body>

</html>