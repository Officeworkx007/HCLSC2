@extends('admin.layouts.master')

@section('title', 'Calendar')
@section('page-title', 'Calendar Management')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css">

    <style>
        #calendar {
            max-width: 100%;
            margin: 20px auto;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        }

        /* Highlight today */
        .fc-day-today {
            background: #fffce8 !important;
            border: 1px solid #fbdc67 !important;
        }

        /* Date number */
        .fc-daygrid-day-number {
            font-weight: 600;
        }

        /* Hover on cells */
        .fc-daygrid-day-frame {
            transition: 0.25s;
            border-radius: 6px;
        }

        .fc-daygrid-day-frame:hover {
            background: #eef6ff;
            cursor: pointer;
        }

        /* Sun–Sat header colors */
        .fc-col-header-cell:nth-child(1) {
            background: #fdecea;
            color: #b91c1c;
        }

        .fc-col-header-cell:nth-child(2) {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .fc-col-header-cell:nth-child(3) {
            background: #ecfeff;
            color: #0369a1;
        }

        .fc-col-header-cell:nth-child(4) {
            background: #f0fdf4;
            color: #166534;
        }

        .fc-col-header-cell:nth-child(5) {
            background: #fffbeb;
            color: #92400e;
        }

        .fc-col-header-cell:nth-child(6) {
            background: #fdf4ff;
            color: #7e22ce;
        }

        .fc-col-header-cell:nth-child(7) {
            background: #fff7ed;
            color: #9a3412;
        }

        .fc-col-header-cell {
            font-weight: 600;
            padding: 8px 0;
        }

        /* Event list box */
        .event-box {
            background: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
        }
    </style>
@endpush

@section('content')
    <div class="container">

        {{-- Calendar --}}
        <div id="calendar"></div>

        {{-- Event List --}}
        <div class="mt-5">
            <h4 class="mb-3">
                Events on <span id="selected-date-text">Select a date</span>
            </h4>

            <div id="events-container">
                <p class="text-muted">Click a date on the calendar to view events.</p>
            </div>
        </div>

    </div>

    {{-- VIEW EVENT MODAL --}}
    <div id="viewEventModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h3 class="text-lg font-semibold mb-2" id="view-title"></h3>
            <p class="text-sm text-gray-600 mb-2" id="view-date"></p>
            <p class="mb-3" id="view-description"></p>

            <div class="mt-4 flex justify-end gap-2">

                <a id="edit-link" class="btn btn-primary btn-sm">
                    Edit
                </a>

                <form method="POST" id="delete-event-form"
                    onsubmit="return confirm('Are you sure you want to delete this event?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </form>

                <button onclick="closeViewModal()" class="btn btn-secondary btn-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                navLinks: true,
                dayMaxEvents: true,

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth'
                },

                events: '{{ route('admin.calendar.getEvents.json') }}',

                dateClick: function(info) {
                    document.getElementById('event_date').value = info.dateStr;

                    let modal = document.getElementById('addEventModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    loadEventsForDate(info.dateStr);
                },

                eventClick: function(info) {

                    document.getElementById('view-title').innerText = info.event.title;
                    document.getElementById('view-date').innerText = info.event.startStr;
                    document.getElementById('view-description').innerText =
                        info.event.extendedProps.description ?? '';

                    // Edit link
                    document.getElementById('edit-link').href =
                        `{{ url('admin/calendar') }}/${info.event.id}/edit`;

                    // Delete form action
                    document.getElementById('delete-event-form').action =
                        `{{ url('admin/calendar') }}/${info.event.id}`;

                    let modal = document.getElementById('viewEventModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
            });

            calendar.render();

            function loadEventsForDate(date) {
                document.getElementById('selected-date-text').innerText = date;

                fetch(`{{ route('admin.calendar.getEvents') }}?date=` + date)
                    .then(res => res.json())
                    .then(data => {
                        let container = document.getElementById('events-container');
                        container.innerHTML = '';

                        if (!data.length) {
                            container.innerHTML =
                                `<p class="text-danger">No events found on this date.</p>`;
                            return;
                        }

                        data.forEach(event => {
                            container.innerHTML += `
                        <div class="event-box">
                            <h5>${event.title}</h5>
                            <p>${event.description ?? ''}</p>

                            <div class="d-flex gap-2 mt-2">
                                <a href="{{ url('admin/calendar') }}/${event.id}/edit"
                                   class="btn btn-primary btn-sm">Edit</a>

                                <form method="POST"
                                      action="{{ url('admin/calendar') }}/${event.id}"
                                      onsubmit="return confirm('Delete this event?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    `;
                        });
                    });
            }

            window.closeViewModal = function() {
                let modal = document.getElementById('viewEventModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            };

            window.closeAddModal = function() {
                let modal = document.getElementById('addEventModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            };
        });
    </script>
@endpush
