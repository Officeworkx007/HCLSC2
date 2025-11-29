@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')
@section('page-title', 'View Notices')

@push('styles')
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <style>
        /* Table wrapper for horizontal scroll */
        .table-wrapper {
            overflow-x: auto;
        }

        #panelLawyersTable {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            font-size: 0.95rem;
            background-color: #ffffff;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        #panelLawyersTable th {
            background: linear-gradient(90deg, #1e3a8a, #2563eb);
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            padding: 0.75rem 1rem;
            text-align: left;
            letter-spacing: 0.5px;
        }

        #panelLawyersTable td {
            padding: 0.65rem 1rem;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
            color: #374151;
        }

        #panelLawyersTable tbody tr {
            transition: all 0.2s ease-in-out;
        }

        #panelLawyersTable tbody tr:hover {
            background-color: #f3f4f6;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.03);
        }

        #panelLawyersTable tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        /* Actions buttons modern look */
        .flex.justify-center.gap-2 a,
        .flex.justify-center.gap-2 button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
        }

        .flex.justify-center.gap-2 a:hover,
        .flex.justify-center.gap-2 button:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        /* Lightbox image stays same */
        #lightboxImage {
            max-width: 90vw;
            max-height: 90vh;
            object-fit: contain;
        }


        /* Primary Admin Button */
        .admin-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 1.1rem;
            background: linear-gradient(90deg, #1e3a8a, #2563eb);
            color: #ffffff;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 0.5rem;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            transition: all 0.18s ease-in-out;
            text-decoration: none;
            letter-spacing: 0.3px;
        }

        .admin-btn-primary:hover {
            background: linear-gradient(90deg, #23398f, #1d4ed8);
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.20);
            color: #fff;
        }

        .admin-btn-primary i {
            font-size: 0.9rem;
        }
    </style>
@endpush

@section('content')
<div class="w-full p-6 bg-white shadow-xl rounded-2xl">

    {{-- Success Message --}}
@if (session('success'))
    <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg shadow-md transition-opacity duration-500">
        <p class="font-bold">Success</p>
        <p>{{ session('success')}}</p>
    </div>
@endif

{{-- Header --}}
<div class="">
@endsection
