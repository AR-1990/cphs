@extends('admin.main')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.css">
    <style>
        #calendar {
            max-width: 800px;
            margin: 40px auto;

        }

        .fc-event {
            border: 1px solid #eee !important;
        }

        .fc-content {
            padding: 3px !important;
        }

        .fc-content .fc-title {
            display: block !important;
            overflow: hidden;
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
        }



        .form-group {
            margin-bottom: 1rem;
        }

        .form-group>label {
            margin-bottom: 10px;
        }

        #delete-modal .modal-footer>.btn {

            border-radius: 3px !important;
            padding: 0px 8px !important;
            font-size: 15px;

        }




        .fc-scroller {
            overflow-y: hidden !important;
        }

        .context-menu {
            position: absolute;
            z-index: 1000;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3);
            padding: 5px;
        }

        /* .context-menu.show {
                                    display: block;
                                  } */

        .context-menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;

        }

        .context-menu ul>li {
            display: block;
            ;
            padding: 5px 15px;
            list-style-type: none;
            color: #333;
            display: block;
            cursor: pointer;
            margin: 0 auto;
            transition: 0.10s;
            font-size: 13px;


        }

        .context-menu ul>li:hover {
            color: #fff;
            background-color: #007bff;
            border-radius: 2px;

        }

        .fa,
        .fas {
            font-size: 13px;
            margin-right: 4px;
        }

        .modal-backdrop.fade {
            opacity: 0 !important;
        }

        .modal-backdrop {
            position: static !important;
        }

        .custom-tooltip {
            background-color: #0b0120 !important;
            /* Set your desired background color here */
            color: #e8d8d8 !important;
            /* Set text color */
            border: 1px solid #ccc !important;
            /* Set border color */
        }

        .center-text {
            text-align: center !important;
            margin-top: 5px !important;
        }
        .fc-scroller.fc-day-grid-container{
            height: auto!important;
        }
    </style>
    <div class="container">

        @if (Session::has('error_message'))
            <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
                {{-- <strong>Error ! </strong> --}}
                {{ Session::get('error_message') }}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                    data-bs-original-title="" title=""></button>
            </div>
        @endif

        @if (Session::has('success_message'))
            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                {{-- <strong>Success ! </strong> --}}
                {{ Session::get('success_message') }}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                    data-bs-original-title="" title=""></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
    <div id='calendar'></div>


    <div class="modal fade edit-form" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        style="z-index: 999">
        <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="modal-title">Add Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="myForm">
                    <div class="modal-body">
                        <div class="alert alert-danger " role="alert" id="danger-alert" style="display: none;">
                            End date should be greater than start date.
                        </div>
                        <div class="form-group">
                            <label for="event-title">Event name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="event-title" placeholder="Enter event name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="start-date">Start date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="start-date" placeholder="start-date" required>
                        </div>
                        <div class="form-group">
                            <label for="end-date">End date - <small class="text-muted">Optional</small></label>
                            {{-- <label for="end-date">End date</label> --}}
                            <input type="date" class="form-control" id="end-date" placeholder="end-date">
                        </div>
                        <div class="form-group">
                            <label for="event-color">Color</label>
                            <input type="color" class="form-control" id="event-color" value="#3788d8" required>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                        <input type="hidden" readonly class="form-control" id="UpdateID" value="0" required>

                        <button type="submit" class="btn btn-primary" id="submit-button">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" id="delete-modal-body">
                    Are you sure you want to delete the event?
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary rounded-sm" data-dismiss="modal"
                        id="cancel-button">Cancel</button>
                    <button type="button" class="btn btn-danger rounded-lg" id="delete-button">Delete</button>
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.2.0/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.2.0/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uuid@8.3.2/dist/umd/uuidv4.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const calendarEl = document.getElementById('calendar');
            const myModal = new bootstrap.Modal(document.getElementById('form'));
            const dangerAlert = document.getElementById('danger-alert');
            const close = document.querySelector('.btn-close');

            localStorage.clear();

            const myEvents = JSON.parse(localStorage.getItem('events')) ||

                <?php
                
                echo json_encode($CalendarEventsArr);
                
                ?>

            /*[
               {
             id: uuidv4(),
                                    title: `One Event`,
                                    start: '2024-08-12',
                                    end: '2024-08-12',
                                    backgroundColor: 'blue',
                                    allDay: true,
                                    editable: true,
                                    editable: true,
                                    event_type: '123456',
                                    extraParams: {
                                    custom_param1: 'something',
                                    custom_param2: 'somethingelse'
                                     },

                                },
                                {
                                    id: uuidv4(),
                                    title: `Delete me`,
                                    start: '2024-08-17',
                                    end: '2024-08-17',
                                    allDay: true,
                                    editable: true,
                                    event_type: '123456',
                                    backgroundColor: 'blue',

                                },
                            ];*/


            const calendar = new FullCalendar.Calendar(calendarEl, {

                /*customButtons: {
                    customButton: {
                        text: 'Add Event',
                        click: function() {
                            myModal.show();
                            const modalTitle = document.getElementById('modal-title');
                            const submitButton = document.getElementById('submit-button');
                            const eventTitle = document.getElementById('event-title');

                            modalTitle.innerHTML = 'Add Event';
                            submitButton.innerHTML = 'Add Event';
                            submitButton.classList.remove('btn-primary');
                            submitButton.classList.add('btn-primary');
                            eventTitle.value = "";

                            close.addEventListener('click', () => {
                                myModal.hide();
                            });
                        },
                    },
                },*/

                header: {
                    center: 'customButton',
                    right: 'dayGridYear,dayGridMonth,dayGridWeek,dayGridDay,today,prev,next', // Add views to the right section
                },

                views: {
                    dayGridYear: { // Define the custom Year view
                        type: 'dayGrid',
                        duration: {
                            years: 1
                        }, // Show one full year
                        buttonText: 'Year' // Label for the button
                    }
                },

                plugins: ['dayGrid', 'interaction', 'bootstrap'],
                // allDay: false,
                // editable: true,
                // selectable: true,
                // unselectAuto: false,
                // displayEventTime: false,
                events: myEvents,

                eventRender: function(info, element) {

                   /* console.log("myEvents")
                    console.log(myEvents)
                    console.log("---------------------------------------------------");
                    console.log(info);
                    console.log("info event " + info.event);
                    console.log("info.el " + info.el);
                    console.log("info.event.id " + info.event.id);
                    console.log("info.event.title " + info.event.title);
                    console.log("info.event.start " + info.event.start);
                    console.log("info.event.end " + info.event.end);
                    console.log("info.event.backgroundColor " + info.event.backgroundColor);
                    console.log("info.event.allDay " + info.event.allDay);
                    console.log("info.event.editable " + info.event.editable);
                    console.log("info.event.extendedProps.event_type " + info.event.extendedProps.event_type);
                    console.log("info.event.extendedProps.event_id " + info.event.extendedProps.event_type);
                    console.log("info.event.extendedProps.extraParams.custom_param1: " + info.event.extendedProps.extraParams.custom_param1);*/


                    $(info.el).tooltip({


                        title: function() {


                            /* Screening  = event_type 2 */
                            if (info.event.extendedProps.event_type != null && info.event
                                .extendedProps.event_type == 2) {

                                var tooltipContent = 
                                '<strong>Title: ' + info.event.title +'</strong><br>' +
                                '<strong>School: ' +info.event.extendedProps.extraParams.custom_param1 +'</strong><br>' +
                                '<strong>Date: ' + moment(info.event.start).format('YYYY-MM-DD') + '</strong><br>';

                                if (info.event.extendedProps.description != null) {

                                    tooltipContent += '<strong>Internal Referral: ' + info
                                        .event
                                        .extendedProps.description + '</strong><br>';

                                }

                            } else {

                                var tooltipContent = '<strong>Event Title: ' + info.event
                                    .title +
                                    '</strong><br>' +
                                    '<strong>Referal Date: ' + moment(info.event.start)
                                    .format(
                                        'YYYY-MM-DD') + '</strong><br>';

                                if (info.event.extendedProps.description != null) {

                                    tooltipContent += '<strong>Description: ' + info.event
                                        .extendedProps.description + '</strong><br>';

                                }

                            }


                            // Check if end date exists and if it's a valid date
                            /*if (info.event.end && moment(info.event.end).isValid()) {
                                tooltipContent += '<strong>End: ' + moment(info.event.end)
                                    .format('YYYY-MM-DD') + '</strong><br>';
                            }*/



                            /* Screening  = event_type 2 */
                            /*if (info.event.extendedProps.event_type != null && info.event
                                .extendedProps.event_type == 2) {


                                tooltipContent +='<div class="center-text"><strong>Internal Findings</strong></div>';



                            }*/

                            return tooltipContent;
                        },

                        html: true,
                        placement: 'top',
                        template: '<div class="tooltip" role="tooltip"><div class="tooltip-inner calendar-tooltip-color"></div></div>'

                    });


                    info.el.addEventListener('contextmenu', function(e) {

                        e.preventDefault();

                        /*console.log("---------------------------------------------------");
                        console.log("info.event " + info.event);
                        console.log("info.event.id " + info.event.id);
                        console.log("info.event.title " + info.event.title);
                        console.log("info.event.start " + info.event.start);
                        console.log("info.event.end " + info.event.end);
                        console.log("info.event.backgroundColor " + info.event.backgroundColor);
                        console.log("info.event.event_type " + info.event.event_type);
                        console.log("info.event.extendedProps.event_type " + info.event
                            .extendedProps.event_type);*/


                        let existingMenu = document.querySelector('.context-menu');
                        existingMenu && existingMenu.remove();
                        let menu = document.createElement('div');
                        menu.className = 'context-menu';

                        if (info.event.extendedProps.event_type == 0) {
                            menu.innerHTML = `<ul>
                            <li><i class="fas fa-edit"></i> Edit</li>
                            <li><i class="fas fa-trash-alt"></i> Delete</li>
                            </ul>`;

                        }

                        const eventIndex = myEvents.findIndex(event => event.id === info.event
                            .id);

                        document.body.appendChild(menu);
                        menu.style.top = e.pageY + 'px';
                        menu.style.left = e.pageX + 'px';

                        // Edit context menu

                        menu.querySelector('li:first-child').addEventListener('click',

                            function() {

                                menu.remove();

                                const editModal = new bootstrap.Modal(document
                                    .getElementById('form'));
                                const modalTitle = document.getElementById('modal-title');
                                const titleInput = document.getElementById('event-title');
                                const startDateInput = document.getElementById(
                                    'start-date');
                                const endDateInput = document.getElementById('end-date');
                                const colorInput = document.getElementById('event-color');
                                const submitButton = document.getElementById(
                                    'submit-button');
                                const cancelButton = document.getElementById(
                                    'cancel-button');
                                const UpdateID = document.getElementById('UpdateID');

                                modalTitle.innerHTML = 'Edit Event';
                                titleInput.value = info.event.title;
                                startDateInput.value = moment(info.event.start).format(
                                    'YYYY-MM-DD');
                                // endDateInput.value = moment(info.event.end, 'YYYY-MM-DD').subtract(1, 'day').format('YYYY-MM-DD');
                                endDateInput.value = moment(info.event.end).format(
                                    'YYYY-MM-DD');
                                colorInput.value = info.event.backgroundColor;
                                submitButton.innerHTML = 'Save Changes';
                                UpdateID.value = info.event.id;


                                /* console.log(
                                     "---------------------------------------------------"
                                     );
                                 console.log("info.event.id " + info.event.id);
                                 console.log("info.event.title " + info.event.title);
                                 console.log("info.event.start " + info.event.start);
                                 console.log("info.event.end " + info.event.end);
                                 console.log("info.event.backgroundColor " + info.event
                                     .backgroundColor);*/


                                editModal.show();

                                submitButton.classList.remove('btn-success')
                                submitButton.classList.add('btn-primary')

                                // Edit button


                                submitButton.addEventListener('click', function() {

                                    /* console.log("---------------------------------------------------");
                                     console.log("info.event.id " + info.event.id);
                                     console.log("info.event.title " + info.event.title);
                                     console.log("info.event.start " + info.event.start);
                                     console.log("info.event.end " + info.event.end);
                                     console.log("info.event.backgroundColor " + info.event.backgroundColor);*/


                                    var base_url = '{!! Route('Calendar') !!}';


                                    $.ajax({
                                        url: base_url,
                                        type: "post",
                                        data: {
                                            "_token": "{{ csrf_token() }}",
                                            UpdateID: info.event.id,
                                            title: titleInput.value,
                                            startDate: startDateInput.value,
                                            endDate: endDateInput.value,
                                            color: colorInput.value,

                                        },

                                        dataType: 'json',



                                        success: function(resp) {

                                            /* console.log("resp id " + resp.id);
                                             console.log("resp status " + resp['status']);
                                             console.log("resp " + resp);
                                             console.log("resp length " + resp.length);
                                             console.log("resp " + JSON.stringify(resp));*/

                                            if (resp['status'] ===
                                                true) {

                                                Swal.fire({
                                                    position: 'center',
                                                    // position: 'top-end',
                                                    icon: 'success',
                                                    title: resp[
                                                        'message'
                                                    ],
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function() {

                                                    // location.reload();
                                                    const
                                                        updatedEvents = {
                                                            id: UpdateID,
                                                            title: titleInput
                                                                .value,
                                                            start: startDateInput
                                                                .value,
                                                            // end: endDateInput.value,
                                                            end: moment(
                                                                    info
                                                                    .event
                                                                    .end,
                                                                    'YYYY-MM-DD'
                                                                )
                                                                .subtract(
                                                                    1,
                                                                    'day'
                                                                )
                                                                .format(
                                                                    'YYYY-MM-DD'
                                                                ),
                                                            // end: moment(info.event.end).format('YYYY-MM-DD'),
                                                            backgroundColor: colorInput
                                                                .value
                                                        }

                                                    if (updatedEvents
                                                        .end <=
                                                        updatedEvents
                                                        .start
                                                    ) { // add if statement to check end date
                                                        dangerAlert
                                                            .style
                                                            .display =
                                                            'block';
                                                        return;
                                                    }

                                                    const
                                                        eventIndex =
                                                        myEvents
                                                        .findIndex(
                                                            event =>
                                                            event
                                                            .id ===
                                                            updatedEvents
                                                            .id
                                                        );
                                                    myEvents
                                                        .splice(
                                                            eventIndex,
                                                            1,
                                                            updatedEvents
                                                        );
                                                    localStorage
                                                        .setItem(
                                                            'events',
                                                            JSON
                                                            .stringify(
                                                                myEvents
                                                            )
                                                        );

                                                    // Update the event in the calendar
                                                    const
                                                        calendarEvent =
                                                        calendar
                                                        .getEventById(
                                                            info
                                                            .event
                                                            .id
                                                        );
                                                    // const calendarEvent = calendar.getEventById(UpdateID);
                                                    console.log(
                                                        "calendarEvent " +
                                                        calendarEvent
                                                    );
                                                    // console.log("JSON.stringify(calendarEvent) "+ JSON.stringify(calendarEvent));
                                                    calendarEvent
                                                        .setProp(
                                                            'title',
                                                            updatedEvents
                                                            .title
                                                        );
                                                    calendarEvent
                                                        .setStart(
                                                            updatedEvents
                                                            .start
                                                        );
                                                    calendarEvent
                                                        .setEnd(
                                                            updatedEvents
                                                            .end
                                                        );
                                                    calendarEvent
                                                        .setProp(
                                                            'backgroundColor',
                                                            updatedEvents
                                                            .backgroundColor
                                                        );

                                                    dangerAlert
                                                        .style
                                                        .display =
                                                        'none';

                                                    editModal
                                                        .hide();

                                                    myModal
                                                        .hide();


                                                    $("#form")
                                                        .hide();

                                                });


                                            } else {
                                                Swal.fire({
                                                    position: 'center',
                                                    // position: 'top-end',
                                                    icon: 'error',
                                                    title: resp[
                                                        'message'
                                                    ],
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function() {

                                                    location
                                                        .reload();

                                                });
                                            }



                                        }
                                    });



                                });
                            });

                        // Delete menu
                        menu.querySelector('li:last-child').addEventListener('click',
                            function() {
                                const deleteModal = new bootstrap.Modal(document
                                    .getElementById('delete-modal'));
                                const modalBody = document.getElementById(
                                    'delete-modal-body');
                                const cancelModal = document.getElementById(
                                    'cancel-button');
                                modalBody.innerHTML =
                                    `Are you sure you want to delete <b>"${info.event.title}"</b>`
                                deleteModal.show();

                                // console.log("info.event.id " + info.event.id);
                                // console.log("info.event.title " + info.event.title);

                                const deleteButton = document.getElementById(
                                    'delete-button');

                                deleteButton.addEventListener('click', function() {

                                    var base_url = '{!! Route('CalendarDelete') !!}';
                                    // console.log("base_url " + base_url);

                                    $.ajax({
                                        url: base_url,
                                        type: "post",
                                        data: {
                                            "_token": "{{ csrf_token() }}",
                                            id: info.event.id
                                        },

                                        dataType: 'json',
                                        beforeSend: function() {

                                            console.log(
                                                "----------- beforeSend -------------"
                                            );
                                        },

                                        success: function(resp) {
                                            // console.log("resp id " +
                                            //     resp.id);
                                            // console.log("resp status " +
                                            //     resp['status']);
                                            // console.log("resp " + resp);
                                            // console.log("resp length " +
                                            //     resp.length);
                                            // console.log("resp " + JSON
                                            //     .stringify(resp));

                                            if (resp['status'] ===
                                                true) {

                                                Swal.fire({
                                                    position: 'center',
                                                    // position: 'top-end',
                                                    icon: 'success',
                                                    title: resp[
                                                        'message'
                                                    ],
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function() {



                                                    myEvents
                                                        .splice(
                                                            eventIndex,
                                                            1);
                                                    localStorage
                                                        .setItem(
                                                            'events',
                                                            JSON
                                                            .stringify(
                                                                myEvents
                                                            )
                                                        );
                                                    calendar
                                                        .getEventById(
                                                            info
                                                            .event
                                                            .id)
                                                        .remove();
                                                    deleteModal
                                                        .hide();
                                                    menu
                                                        .remove();


                                                });


                                            } else {
                                                Swal.fire({
                                                    position: 'center',
                                                    // position: 'top-end',
                                                    icon: 'error',
                                                    title: resp[
                                                        'message'
                                                    ],
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function() {

                                                    location
                                                        .reload();

                                                });
                                            }



                                        }
                                    });



                                });

                                cancelModal.addEventListener('click', function() {
                                    deleteModal.hide();
                                });
                            });
                        document.addEventListener('click', function() {
                            menu.remove();
                        });
                    });

                },

                eventClick: function(info) {


                    /*console.log("----------------------eventClick-----------------------------");
                    console.log(info);
                    console.log("info event " + info.event);
                    // console.log("info event stringify " + JSON.stringify(info.event));
                    console.log("info.event.id " + info.event.id);
                    console.log("info.event.title " + info.event.title);
                    console.log("info.event.start " + info.event.start);
                    console.log("info.event.end " + info.event.end);
                    console.log("info.event.backgroundColor " + info.event.backgroundColor);
                    console.log("info.event.allDay " + info.event.allDay);
                    console.log("info.event.editable " + info.event.editable);
                    console.log("info.event.extendedProps.event_type " + info.event.extendedProps.event_type);
                    console.log("info.event.extendedProps.redirect_link " + info.event.extendedProps.redirect_link);*/

                    /* Medical History  = event_type 1 */

                    if (info.event.extendedProps.event_type == 1 && info.event.extendedProps
                        .redirect_link != null) {

                        var redirectLink = info.event.extendedProps.redirect_link.trim();
                        window.open(redirectLink, '_blank');

                    }

                    /* Screening  = event_type 2 */
                    else if (info.event.extendedProps.event_type == 2 && info.event.extendedProps
                        .redirect_link != null) {

                        var redirectLink = info.event.extendedProps.redirect_link.trim();
                        window.open(redirectLink, '_blank');

                    }

                },

                eventDrop: function(info) {
                    let myEvents = JSON.parse(localStorage.getItem('events')) || [];
                    const eventIndex = myEvents.findIndex(event => event.id === info.event.id);
                    const updatedEvent = {
                        ...myEvents[eventIndex],
                        id: info.event.id,
                        title: info.event.title,
                        start: moment(info.event.start).format('YYYY-MM-DD'),
                        // end: moment(info.event.end).format('YYYY-MM-DD'),
                        end: moment(info.event.end, 'YYYY-MM-DD').subtract(1, 'day').format(
                            'YYYY-MM-DD'),
                        backgroundColor: info.event.backgroundColor
                    };
                    myEvents.splice(eventIndex, 1,
                        updatedEvent); // Replace old event data with updated event data
                    localStorage.setItem('events', JSON.stringify(myEvents));
                    console.log(updatedEvent);
                }

            });

            calendar.on('select', function(info) {
                console.log("info " + info);
                // console.log("info stringify "+ JSON.stringify(info));

                const startDateInput = document.getElementById('start-date');
                const endDateInput = document.getElementById('end-date');
                startDateInput.value = info.startStr;

                const endDate = moment(info.endStr, 'YYYY-MM-DD').subtract(1, 'day').format('YYYY-MM-DD');
                endDateInput.value = endDate;
                if (startDateInput.value === endDate) {
                    endDateInput.value = '';
                }

            });

            calendar.render();

            const form = document.querySelector('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // prevent default form submission

                // retrieve the form input values
                const title = document.querySelector('#event-title').value;
                const startDate = document.querySelector('#start-date').value;
                const endDate = document.querySelector('#end-date').value;
                const color = document.querySelector('#event-color').value;
                const endDateFormatted = moment(endDate, 'YYYY-MM-DD').add(1, 'day').format('YYYY-MM-DD');
                // const eventId = uuidv4();
                const UpdateID = document.getElementById('UpdateID').value;

                /*console.log("---------------------------------------------------");
                console.log("title " + title);
                console.log("startDate " + startDate);
                console.log("endDate " + endDate);
                console.log("color " + color);
                console.log("eventId " + eventId);
                console.log("UpdateID " + UpdateID);*/


                if (endDateFormatted <= startDate) {
                    // add if statement to check end date
                    dangerAlert.style.display = 'block';
                    return;
                }



                var base_url = '{!! Route('Calendar') !!}';
                // console.log("base_url " + base_url);

                $.ajax({
                    url: base_url,
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        UpdateID: UpdateID,
                        title: title,
                        startDate: startDate,
                        endDate: endDate,
                        color: color,
                    },

                    dataType: 'json',
                    beforeSend: function() {

                        // console.log("----------- beforeSend -------------");
                    },

                    success: function(resp) {
                        // console.log("resp id " + resp.id);
                        // console.log("resp status " + resp['status']);
                        // console.log("resp " + resp);
                        // console.log("resp length " + resp.length);
                        console.log("resp " + JSON.stringify(resp));

                        if (resp['status'] === true) {

                            Swal.fire({
                                position: 'center',
                                // position: 'top-end',
                                icon: 'success',
                                title: resp['message'],
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {

                                // location.reload();

                                const newEvent = {
                                    id: resp['CalendarEventsReturnID'],
                                    title: title,
                                    start: startDate,
                                    end: endDateFormatted,
                                    allDay: false,
                                    backgroundColor: color
                                };

                                // // add the new event to the myEvents array
                                // myEvents.push(newEvent);

                                // // render the new event on the calendar
                                calendar.addEvent(newEvent);

                                // // save events to local storage
                                // localStorage.setItem('events', JSON.stringify(myEvents));

                                myModal.hide();

                                dangerAlert.style.display = 'none';

                                form.reset();



                            });


                        } else {
                            Swal.fire({
                                position: 'center',
                                // position: 'top-end',
                                icon: 'error',
                                title: resp['message'],
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {

                                location.reload();

                            });
                        }



                    }
                });


            });

            myModal._element.addEventListener('hide.bs.modal', function() {
                dangerAlert.style.display = 'none';
                form.reset();
            });

        });
    </script>
@endsection
