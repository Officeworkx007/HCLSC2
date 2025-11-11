<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High Court Legal Services Committee, Manipur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

{{-- Background changed to a cleaner, slightly off-white gray-50 --}}
<body class="min-h-screen bg-gray-50 flex flex-col font-sans">
    @include('homepage.layouts.header')

    <div class="flex flex-col items-center py-10 px-4 w-full flex-grow">

        {{-- ✅ Flash Success Message (NIC Style: Blue/Green Border and Text) --}}
        @if (session('success'))
            <div id="successMessage" class="bg-white border-l-4 border-green-600 text-green-800 p-4 rounded shadow-md mb-6 w-full max-w-xs sm:max-w-xl text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ Token Message (NIC Style: Stronger Blue) --}}
        @if (session('token_number'))
            <div id="tokenMessage" class="bg-blue-50 border border-blue-300 text-blue-800 p-4 rounded shadow-sm mb-6 w-full max-w-xs sm:max-w-xl flex flex-col sm:flex-row justify-between items-center gap-2">
                <span class="font-medium">Your Token Number: <strong class="text-blue-700">{{ session('token_number') }}</strong></span>
                <button onclick="document.getElementById('tokenMessage').remove()" class="text-gray-500 font-bold px-2 py-1 rounded hover:bg-gray-200 transition">X</button>
            </div>
        @endif

        {{-- ✅ Tracking Form (NIC Style: Cleaner box, prominent blue button) --}}
        <div class="bg-white shadow-lg rounded-lg border border-gray-200 p-8 w-full max-w-xs sm:max-w-xl mb-10">
            <h2 class="text-2xl font-bold mb-6 text-gray-700 text-center border-b pb-3">Track Your Legal Aid Application</h2>
            <form method="POST" action="{{ route('homepage.track.status') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="token" placeholder="Enter Token Number"
                        value="{{ session('token_input', old('token')) }}"
                        class="border border-gray-300 rounded-md px-4 py-2 w-full focus:ring-blue-600 focus:border-blue-600 transition duration-150" required>
                    <input type="text" name="name" placeholder="Enter Applicant Name"
                        value="{{ session('name_input', old('name')) }}"
                        class="border border-gray-300 rounded-md px-4 py-2 w-full focus:ring-blue-600 focus:border-blue-600 transition duration-150" required>
                </div>
                <div class="flex justify-center pt-2">
                    <button type="submit" class="bg-blue-600 text-white font-semibold tracking-wide px-8 py-2 rounded-md hover:bg-blue-700 transition duration-200 shadow-md">
                        Check Status
                    </button>
                </div>
            </form>
        </div>

        {{-- ❌ Error Message (NIC Style: Red Border and Text) --}}
        @if (isset($error))
            <div class="bg-white border-l-4 border-red-600 text-red-800 p-4 rounded shadow-md w-full max-w-xs sm:max-w-xl mb-6 text-center">
                {{ $error }}
            </div>
        @endif

        {{-- ✅ Tracking Display (NIC Style: Prominent Blue Section Header) --}}
        @if (isset($form) && $form)
            <div class="bg-white shadow-xl rounded-lg border-t-4 border-blue-600 p-8 w-full max-w-xs sm:max-w-xl mb-10">
                <h3 class="text-xl font-bold mb-6 text-center text-blue-800 border-b pb-3">Application Status Details</h3>

                {{-- Basic Applicant Info (Structured list) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm mb-6 p-4 border rounded-md bg-gray-50">
                    <p class="font-medium">Name: <span class="font-normal text-gray-700">{{ $form->name }}</span></p>
                    <p class="font-medium">Token Number: <span class="font-normal text-blue-700">{{ $form->token_number }}</span></p>
                    <p class="font-medium">Phone: <span class="font-normal text-gray-700">{{ $form->number }}</span></p>
                    <p class="font-medium">Email: <span class="font-normal text-gray-700">{{ $form->email }}</span></p>
                    <p class="font-medium">Submitted On: <span class="font-normal text-gray-700">{{ $form->created_at->format('d M Y') }}</span></p>
                    <p class="font-medium">Status:
                        @if ($form->status === 'Pending')
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fa-solid fa-hourglass-half mr-1"></i> Pending Review
                            </span>
                        @elseif ($form->status === 'Rejected')
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fa-solid fa-circle-xmark mr-1"></i> Rejected
                            </span>
                        @elseif ($form->status === 'Assigned')
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fa-solid fa-check-circle mr-1"></i> Lawyer Assigned
                            </span>
                        @else
                            <span class="text-gray-500 font-normal">{{ $form->status }}</span>
                        @endif
                    </p>
                </div>

                {{-- 🎯 Status-Specific Display --}}
                @if ($form->status === 'Pending')
                    <div class="p-5 bg-yellow-50 border border-yellow-300 rounded-md text-center">
                        <i class="fa-solid fa-clock text-yellow-600 text-3xl mb-2"></i>
                        <p class="font-semibold text-yellow-800">Your application is currently under scrutiny by the committee.</p>
                        <p class="text-sm text-yellow-700 mt-1">Please check back soon for an update on lawyer assignment.</p>
                    </div>

                @elseif ($form->status === 'Rejected')
                    <div class="p-5 bg-red-50 border border-red-300 rounded-md text-center">
                        <i class="fa-solid fa-ban text-red-600 text-3xl mb-2"></i>
                        <p class="font-semibold text-red-800">Application Status: Rejected.</p>
                        @if ($form->rejection && $form->rejection->remark)
                            <p class="mt-2 text-sm text-red-700"><strong>Reason for Rejection:</strong> {{ $form->rejection->remark }}</p>
                        @endif
                    </div>

                @elseif ($form->status === 'Assigned')
                    <div class="space-y-6">
                        {{-- Lawyer Details Card --}}
                        <div class="p-5 bg-green-50 border border-green-300 rounded-md text-center">
                            <i class="fa-solid fa-gavel text-green-600 text-3xl mb-2"></i>
                            <p class="font-semibold text-green-800 mb-4">Case Assigned to Panel Lawyer</p>

                            @if ($form->panelLawyer)
                                <div class="bg-white border border-green-200 rounded-md shadow-sm p-4 text-left text-sm space-y-2">
                                    <h4 class="font-bold text-base text-green-700 border-b pb-1">Assigned Counsel Details</h4>
                                    <p><strong>Name:</strong> <span class="font-normal">{{ $form->panelLawyer->first_name }} {{ $form->panelLawyer->last_name }}</span></p>
                                    <p><strong>Contact:</strong> <a href="tel:{{ $form->panelLawyer->phone_number }}" class="text-blue-600 hover:text-blue-800">{{ $form->panelLawyer->phone_number ?? 'N/A' }}</a></p>
                                    <p><strong>Email:</strong> <a href="mailto:{{ $form->panelLawyer->email }}" class="text-blue-600 hover:text-blue-800">{{ $form->panelLawyer->email ?? 'N/A' }}</a></p>
                                </div>
                            @else
                                <p class="text-gray-600 text-sm italic mt-2">Lawyer details will be updated soon.</p>
                            @endif
                        </div>

                        {{-- Case Documents/Order Display --}}
                        <div class="border border-gray-300 rounded-md p-5 bg-white shadow-sm">
                            <h4 class="font-bold text-lg mb-4 text-blue-800 border-b pb-2">Case Orders & Documents</h4>

                            @if ($form->caseDocs->count() > 0)
                                <div class="text-left text-sm space-y-4">
                                    @php
                                        // Group documents by order number
                                        $groupedDocs = $form->caseDocs->groupBy('order_no');
                                    @endphp

                                    @foreach ($groupedDocs as $orderNo => $docs)
                                        <div class="pb-3 border-b border-gray-100 last:border-b-0 last:pb-0">
                                            <p class="font-semibold text-gray-800 mb-1 flex items-center">
                                                <i class="fa-solid fa-list-ol text-blue-600 mr-2"></i> Order/Proceeding No: <span class="text-blue-700 ml-1">{{ $orderNo }}</span>
                                            </p>
                                            <ul class="list-none ml-4 space-y-1">
                                                @foreach ($docs as $doc)
                                                    <li class="flex items-center">
                                                        <i class="fa-solid fa-file-pdf text-red-600 mr-2"></i>
                                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-gray-700 hover:text-blue-600 hover:underline transition">
                                                            {{ $doc->original_name ?? 'View Document' }}
                                                        </a>
                                                        <span class="text-gray-500 text-xs ml-2"> ({{ strtoupper(pathinfo($doc->original_name, PATHINFO_EXTENSION)) }})</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-gray-100 border border-gray-200 rounded-md p-4">
                                    <p class="text-gray-600 text-sm italic text-center">No official case orders or documents have been uploaded yet.</p>
                                </div>
                            @endif
                        </div>
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
