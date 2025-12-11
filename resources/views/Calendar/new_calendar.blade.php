@extends('admin.main')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .calendar-section {
        background-color: #f2f2f2;
        padding: 4rem 0;
    }

    #calendar {
        max-width: 1000px;
        margin: 0 auto;
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }

    .fc-event {
        border-radius: 4px;
        font-size: 14px;
        padding: 2px 4px;
    }

    .event-psychologist {
        background-color: #d86744 !important;
        color: #fff;
        border: none;
    }

    .fc .fc-daygrid-day.fc-day-today {
        background: #d8674420;
    }

    /* Modal styling */
    .custom-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.3s ease forwards;
    }

    .custom-modal-content {
        background: #fff;
        padding: 20px;
        width: 95%;
        max-width: 1100px;
        max-height: 85vh;
        overflow-y: auto;
        border-radius: 10px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        animation: slideUp 0.3s ease forwards;
        transform: translateY(50px);
        opacity: 0;
    }

    .custom-modal.show {
        display: flex;
    }

    @keyframes fadeIn {
        from {
            background-color: rgba(0, 0, 0, 0);
        }

        to {
            background-color: rgba(0, 0, 0, 0.4);
        }
    }

    @keyframes slideUp {
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .custom-modal-header {
        font-weight: bold;
        margin-bottom: 15px;
        font-size: 18px;
    }

    .close-btn {
        float: right;
        cursor: pointer;
        font-size: 20px;
        color: #999;
    }

    .student-table {
        width: 100%;
        border-collapse: collapse;
    }

    .student-table th,
    .student-table td {
        padding: 1rem 0.75rem;
        border-bottom: 1px solid #ccc;
        text-align: left;
        font-size: 14px;
    }

    .student-table th {
        background-color: #f5eae0;
        color: #a94d00;
        text-transform: uppercase;
        font-size: 13px;
    }

    .student-table td {
        background-color: white;
    }

    .show-btn {
        background-color: #d86744 !important;
        color: #fff;
        text-decoration: none;
        padding: 6px 12px;
        font-size: 13px;
        border: none;
        border-radius: 4px;
        font-weight: bold;
    }
    .show-btn:hover,
    .show-btn:focus {
        background-color: #bf5c38;
        color: #fff;
    }

    .fc-col-header-cell-cushion {
        color: #000;
        text-decoration: none;
    }

    .fc-daygrid-day-number {
        color: #000;
        text-decoration: none;
    }

    /* Loader overlay */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: none;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.25);
        z-index: 2000;
    }
    #preloader .spinner-border {
        width: 3rem;
        height: 3rem;
    }
</style>

<div class="container">

    @if (Session::has('error_message'))
    <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
        {{-- <strong>Error ! </strong> --}}
        {{ Session::get('error_message') }}.
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title=""
            title=""></button>
    </div>
    @endif

    @if (Session::has('success_message'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        {{-- <strong>Success ! </strong> --}}
        {{ Session::get('success_message') }}.
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title=""
            title=""></button>
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

<section class="calendar-section">
    <div class="container">
        <div id="calendar"></div>
    </div>
</section>

<!-- Loader overlay -->
<div id="preloader">
    <div class="text-center">
        <div class="spinner-border text-primary" role="status"></div>
        <div class="mt-2 text-dark">Loading...</div>
    </div>
    
</div>

<!-- Modal -->
<div class="custom-modal" id="studentModal" onclick="handleBackdropClick(event)">
    <div class="custom-modal-content" id="studentModalContent">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <div class="custom-modal-header" id="modalHeader">Follow-ups</div>
        <div id="categoryButtons" class="mb-3"></div>
        <table class="student-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Referral Date</th>
                    <th>School Name</th>
                    <th>Class</th>
                    <th>GR Number</th>
                    <th>Reason</th>
                    <th>Follow-Up</th>
                    <th>Show Details</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <!-- JS will populate -->
            </tbody>
        </table>
    </div>
</div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uuid@8.3.2/dist/umd/uuidv4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
    let mainCalendar;

    // Map backend keys to readable category labels
    const CATEGORY_LABELS = {
        "Psychologist": "Psychologist",
        "Nutritionist": "Nutritionist",
        "General Physician": "General Physician"
    };

    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const initialEvents = [];

        mainCalendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'prevYear,prev,next,nextYear today',
                center: 'title',
                end: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                dayGridMonth: 'Month',
                timeGridWeek: 'Week',
                timeGridDay: 'Day'
            },
            datesSet: async function(info) {
                const start = moment(info.start).format('YYYY-MM-DD');
                const end = moment(info.end).subtract(1, 'day').format('YYYY-MM-DD');
                await fetchEventsForRange(start, end);
            },
            dateClick: function(info) {
                fetchFollowupsByDate(info.dateStr);
            },
            events: initialEvents,
            eventClick: function(info) {
                const dateStr = info.event.startStr || moment(info.event.start).format('YYYY-MM-DD');
                const selectedCategory = info.event.title;
                fetchFollowupsByDate(dateStr, selectedCategory);
            }
        });

        mainCalendar.render();
    });

    function closeModal() {
        const modal = document.getElementById("studentModal");
        modal.classList.remove("show");
    }

    function handleBackdropClick(event) {
        const modalContent = document.getElementById("studentModalContent");
        if (!modalContent.contains(event.target)) {
            closeModal();
        }
    }

    function setModalHeader(text) {
        const headerEl = document.getElementById('modalHeader');
        if (headerEl) headerEl.textContent = text;
    }

    function renderCategoryButtons(categories, payloadForDate) {
        const container = document.getElementById('categoryButtons');
        if (!container) return;
        container.innerHTML = '';

        categories.forEach(cat => {
            const btn = document.createElement('button');
            btn.className = 'btn btn-sm btn-primary me-2';
            btn.textContent = cat;
            btn.addEventListener('click', () => {
                setModalHeader(`${cat}`);
                renderStudentsTable(payloadForDate[cat] || []);
            });
            container.appendChild(btn);
        });
    }

    function renderStudentsTable(students) {
        const tbody = document.getElementById("studentTableBody");
        if (!tbody) return;
        tbody.innerHTML = "";

        students.forEach(student => {
            const row = document.createElement("tr");
            const linkCell = student.redirect_link ? `<a href="${student.redirect_link}" target="_blank" class="show-btn">View</a>` : '<button class="show-btn" disabled>View</button>';
            row.innerHTML = `
                <td>${student.name || ''}</td>
                <td>${student.phone || ''}</td>
                <td>${student.referralDate || ''}</td>
                <td>${student.schoolName || ''}</td>
                <td>${student.class || ''}</td>
                <td>${student.grNumber || ''}</td>
                <td>${student.reason || ''}</td>
                <td>${student.followUpType || ''}</td>
                <td>${linkCell}</td>
            `;
            tbody.appendChild(row);
        });
    }

    function showLoader() {
        const l = document.getElementById('preloader');
        if (l) l.style.display = 'flex';
    }

    function hideLoader() {
        const l = document.getElementById('preloader');
        if (l) l.style.display = 'none';
    }

    async function fetchFollowupsByDate(dateStr, selectedCategory = null) {
        try {
            showLoader();
            setModalHeader(`Follow-ups on ${dateStr}`);
            const url = `{{ route('CalendarFollowupsByDate') }}`;
            const response = await fetch(url + `?date=${encodeURIComponent(dateStr)}${selectedCategory ? `&category=${encodeURIComponent(selectedCategory)}` : ''}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();

            const grouped = data.data || {};
            const categories = Object.keys(grouped).filter(cat => Array.isArray(grouped[cat]?.students) && grouped[cat].students.length > 0);

            const payload = {};
            categories.forEach(cat => {
                payload[cat] = grouped[cat].students || [];
            });

            // Show each category button only once, for navigation
            renderCategoryButtons(categories, payload);

            // If a category was clicked on calendar, show only that category's data
            if (selectedCategory && categories.includes(selectedCategory)) {
                setModalHeader(`${selectedCategory}`);
                renderStudentsTable(payload[selectedCategory]);
            } else if (categories.length > 0) {
                setModalHeader(`${categories[0]}`);
                renderStudentsTable(payload[categories[0]]);
            } else {
                setModalHeader(`No follow-ups on ${dateStr}`);
                renderStudentsTable([]);
            }

            hideLoader();
            document.getElementById("studentModal").classList.add("show");
        } catch (e) {
            console.error('Failed to fetch follow-ups:', e);
            hideLoader();
        }
    }

    async function fetchEventsForRange(startStr, endStr) {
        try {
            showLoader();
            const url = `{{ route('new_calendar') }}`;
            const response = await fetch(url + `?start_date=${encodeURIComponent(startStr)}&end_date=${encodeURIComponent(endStr)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const payload = await response.json();
            const events = Array.isArray(payload.events) ? payload.events : [];
            mainCalendar.removeAllEvents();
            events.forEach(ev => mainCalendar.addEvent(ev));
            hideLoader();
        } catch (e) {
            hideLoader();
        }
    }
</script>
@endsection
