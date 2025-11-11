<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High Court Legal Services Committee, Manipur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

{{-- 🏆 Structural Change: Use flex-col and min-h-screen to ensure the footer stays at the bottom --}}
<body class="min-h-screen bg-gray-100 flex flex-col">
    @include('homepage.layouts.header')

    {{-- 🏆 Main Content Wrapper: Add flex-grow to push the footer down --}}
    <div class="flex flex-col items-center py-8 px-4 w-full flex-grow">

        {{-- ✅ Flash Success Message (Updated responsiveness: max-w-full on small screens) --}}
        @if (session('success'))
            <div id="successMessage" class="bg-green-100 text-green-800 p-4 rounded mb-4 w-full max-w-xs sm:max-w-xl text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ Token Message (Updated responsiveness: flex-col on small screens) --}}
        @if (session('token_number'))
            <div id="tokenMessage" class="bg-blue-100 text-blue-800 p-4 rounded mb-4 w-full max-w-xs sm:max-w-xl flex flex-col sm:flex-row justify-between items-center gap-2">
                <span>Your Token Number: <strong>{{ session('token_number') }}</strong></span>
                <button onclick="document.getElementById('tokenMessage').remove()" class="text-red-600 font-bold px-2 py-1 rounded hover:bg-red-100 transition">X</button>
            </div>
        @endif

        {{-- ✅ Tracking Form (Responsive width added) --}}
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-xs sm:max-w-xl mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700 text-center">Track Your Application</h2>
            <form method="POST" action="{{ route('homepage.track.status') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="token" placeholder="Enter Token Number"
                        value="{{ session('token_input', old('token')) }}"
                        class="border rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>
                    <input type="text" name="name" placeholder="Enter Applicant Name"
                        value="{{ session('name_input', old('name')) }}"
                        class="border rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Check Status</button>
                </div>
            </form>
        </div>

        {{-- ❌ Error Message (Responsive width added) --}}
        @if (isset($error))
            <div class="bg-red-100 text-red-700 p-4 rounded w-full max-w-xs sm:max-w-xl mb-4 text-center">
                {{ $error }}
            </div>
        @endif

        {{-- ✅ Tracking Display (Responsive width added) --}}
        @if (isset($form) && $form)
            <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8 w-full max-w-xs sm:max-w-xl mb-10">
                <h3 class="text-lg font-bold mb-6 text-center text-blue-800">Application Status</h3>

                {{-- Basic Applicant Info (Responsive grid) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm mb-6">
                    <p><strong>Name:</strong> {{ $form->name }}</p>
                    <p><strong>Token Number:</strong> {{ $form->token_number }}</p>
                    <p><strong>Phone:</strong> {{ $form->number }}</p>
                    <p><strong>Email:</strong> {{ $form->email }}</p>
                    <p><strong>Submitted On:</strong> {{ $form->created_at->format('d M Y') }}</p>
                    <p><strong>Status:</strong>
                        @if ($form->status === 'Pending')
                            <span class="text-yellow-600 font-semibold">Pending</span>
                        @elseif ($form->status === 'Rejected')
                            <span class="text-red-600 font-semibold">Rejected</span>
                        @elseif ($form->status === 'Assigned')
                            <span class="text-green-600 font-semibold">Lawyer Assigned</span>
                        @else
                            <span class="text-gray-500">{{ $form->status }}</span>
                        @endif
                    </p>
                </div>

                {{-- 🎯 Status-Specific Display (Responsive padding) --}}
                @if ($form->status === 'Pending')
                    <div class="p-4 sm:p-6 bg-yellow-50 border border-yellow-300 rounded-lg text-center">
                        <i class="fa-solid fa-hourglass-half text-yellow-500 text-3xl mb-2 sm:mb-3"></i>
                        <p class="font-medium text-yellow-800">Your application is under review.</p>
                        <p class="text-sm text-yellow-700 mt-1">We will notify you once a lawyer is assigned.</p>
                    </div>

                @elseif ($form->status === 'Rejected')
                    <div class="p-4 sm:p-6 bg-red-50 border border-red-300 rounded-lg text-center">
                        <i class="fa-solid fa-circle-xmark text-red-600 text-3xl mb-2 sm:mb-3"></i>
                        <p class="font-medium text-red-700">Unfortunately, your application was rejected.</p>
                        @if ($form->rejection && $form->rejection->remark)
                            <p class="mt-2 text-sm text-red-600"><strong>Reason:</strong> {{ $form->rejection->remark }}</p>
                        @endif
                    </div>

                @elseif ($form->status === 'Assigned')
                    <div class="p-4 sm:p-6 bg-green-50 border border-green-300 rounded-lg text-center">
                        <i class="fa-solid fa-scale-balanced text-green-600 text-3xl mb-2 sm:mb-3"></i>
                        <p class="font-medium text-green-700 mb-3">A lawyer has been assigned to your case.</p>

                        @if ($form->panelLawyer)
                            <div class="bg-white border border-green-200 rounded-lg shadow-sm p-4 text-left text-sm mb-4">
                                <h4 class="font-bold text-base mb-2 text-green-700">Lawyer Details</h4>
                                <p><strong>Name:</strong> {{ $form->panelLawyer->first_name }} {{ $form->panelLawyer->last_name }}</p>
                                <p><strong>Contact:</strong> <a href="tel:{{ $form->panelLawyer->contact_number }}" class="text-blue-600 hover:text-blue-800">{{ $form->panelLawyer->contact_number ?? 'N/A' }}</a></p>
                                <p><strong>Email:</strong> <a href="mailto:{{ $form->panelLawyer->email }}" class="text-blue-600 hover:text-blue-800">{{ $form->panelLawyer->email ?? 'N/A' }}</a></p>
                            </div>
                        @else
                            <p class="text-gray-600 text-sm italic mb-4">Lawyer details will be updated soon.</p>
                        @endif

                        {{-- Case Documents/Order Display (Responsive padding) --}}
                        <h4 class="font-bold text-base mb-3 text-blue-800">Case Documents & Orders</h4>

                        @if ($form->caseDocs->count() > 0)
                            <div class="bg-white border border-blue-200 rounded-lg shadow-sm p-4 text-left text-sm space-y-3">
                                @php
                                    // Group documents by order number
                                    $groupedDocs = $form->caseDocs->groupBy('order_no');
                                @endphp

                                @foreach ($groupedDocs as $orderNo => $docs)
                                    <div class="border-b pb-2 last:border-b-0 last:pb-0">
                                        <p class="font-semibold text-gray-800 mb-1">Order No: <span class="text-blue-700">{{ $orderNo }}</span></p>
                                        <ul class="list-disc list-inside ml-2 space-y-1">
                                            @foreach ($docs as $doc)
                                                <li>
                                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                                        <i class="fa-solid fa-file-arrow-down mr-1"></i> {{ $doc->original_name ?? 'View Document' }}
                                                    </a>
                                                    <span class="text-gray-500 text-xs"> ({{ strtoupper(pathinfo($doc->original_name, PATHINFO_EXTENSION)) }})</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-4">
                                <p class="text-gray-600 text-sm italic">No case orders or documents uploaded yet.</p>
                                <p class="text-xs text-gray-500 mt-1">Check back later for updates from the legal team.</p>
                            </div>
                        @endif

                    </div>
                @endif
            </div>
        @endif
    </div>

    @include('homepage.layouts.footer')

    <script>
        // Auto-hide success message after 7 seconds
        setTimeout(() => {
            const successBox = document.getElementById('successMessage');
            if (successBox) successBox.remove();
        }, 7000);

        feather.replace();
    </script>
</body>
