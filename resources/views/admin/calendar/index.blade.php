@extends('admin.layouts.master')

@section('title', 'Calendar')
@section('page-title', 'Calendar Management')

@push('styles')
    {{-- FullCalendar CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css">

    <style>
        #calendar {
            max-width: 100%;
            margin: 20px auto;
        }

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

        {{-- Event Details Panel (appears when a date is clicked) --}}
        <div class="mt-5">
            <h4 class="mb-3">Events on <span id="selected-date-text">Select a date</span></h4>

            <div id="events-container">
                <p class="text-muted">Click a date on the calendar to view events.</p>
            </div>
        </div>

    </div>

@endsection

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

        /* Make date numbers bold */
        .fc-daygrid-day-number {
            font-weight: 600;
        }

        /* Event styling */
        .fc-event {
            background: #0d6efd !important;
            border: none !important;
            padding: 3px 6px !important;
            border-radius: 4px !important;
            font-size: 12px !important;
            font-weight: 500 !important;
            color: white !important;
        }

        .fc-event:hover {
            background: #084298 !important;
        }

        /* Hover effect on cells */
        .fc-daygrid-day-frame {
            transition: 0.25s;
            border-radius: 6px;
        }

        .fc-daygrid-day-frame:hover {
            background: #eef6ff;
            cursor: pointer;
        }

        /* Sidebar event list */
        .event-box {
            background: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                navLinks: true,
                dayMaxEvents: true, // Show "+ more"

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth'
                },

                // Load events from backend
                events: '{{ route('admin.calendar.getEvents.json') }}',

                // Date click effect
                dateClick: function(info) {
                    let date = info.dateStr;

                    document.getElementById('selected-date-text').innerText = date;

                    fetch(`{{ route('admin.calendar.getEvents') }}?date=` + date)
                        .then(response => response.json())
                        .then(data => {
                            let container = document.getElementById('events-container');
                            container.innerHTML = '';

                            if (data.length === 0) {
                                container.innerHTML =
                                    `<p class="text-danger">No events found on this date.</p>`;
                                return;
                            }

                            data.forEach(event => {
                                container.innerHTML += `
                            <div class="event-box">
                                <h5>${event.title}</h5>
                                <p>${event.description ?? ''}</p>
                                <a href="{{ url('admin/calendar') }}/${event.id}/edit"
                                    class="btn btn-primary btn-sm mt-2">Edit Event</a>
                            </div>
                        `;
                            });
                        });
                }
            });

            calendar.render();
        });
    </script>
@endpush
