<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High Court Legal Services Committee, Manipur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">
    @include('homepage.layouts.header')

    <div class="min-h-screen flex flex-col items-center py-8 px-4 w-full">

        {{-- ✅ Flash Success Message --}}
        @if (session('success'))
            <div id="successMessage" class="bg-green-100 text-green-800 p-3 rounded mb-4 w-full max-w-2xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ Token Message --}}
        @if (session('token_number'))
            <div id="tokenMessage"
                class="bg-blue-100 text-blue-800 p-3 rounded mb-4 w-full max-w-2xl flex justify-between items-center">
                <span>Your Token Number: <strong>{{ session('token_number') }}</strong></span>
                <button onclick="document.getElementById('tokenMessage').remove()"
                    class="ml-4 text-red-600 font-bold">X</button>
            </div>
        @endif

        {{-- ✅ Tracking Form --}}
        <div class="bg-white shadow-md rounded p-6 w-full max-w-2xl mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700 text-center">Track Your Application</h2>
            <form method="GET" action="{{ route('homepage.track') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="token" placeholder="Enter Token Number"
                        value="{{ request('token') }}"
                        class="border rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>
                    <input type="text" name="name" placeholder="Enter Applicant Name"
                        value="{{ request('name') }}"
                        class="border rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Check
                        Status</button>
                </div>
            </form>
        </div>

        {{-- ❌ Error Message --}}
        @if (isset($error))
            <div class="bg-red-100 text-red-700 p-3 rounded w-full max-w-2xl mb-4">
                {{ $error }}
            </div>
        @endif

        {{-- ✅ Tracking Display --}}
        @if (isset($form) && $form)
            <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-2xl mb-10">
                <h3 class="text-lg font-bold mb-6 text-center text-blue-800">Application Status</h3>

                {{-- Basic Applicant Info --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm mb-6">
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

                {{-- 🎯 Status-Specific Display --}}
                @if ($form->status === 'Pending')
                    <div class="p-6 bg-yellow-50 border border-yellow-300 rounded-lg text-center">
                        <i class="fa-solid fa-hourglass-half text-yellow-500 text-3xl mb-3"></i>
                        <p class="font-medium text-yellow-800">Your application is under review.</p>
                        <p class="text-sm text-yellow-700 mt-1">We will notify you once a lawyer is assigned.</p>
                    </div>

                @elseif ($form->status === 'Rejected')
                    <div class="p-6 bg-red-50 border border-red-300 rounded-lg text-center">
                        <i class="fa-solid fa-circle-xmark text-red-600 text-3xl mb-3"></i>
                        <p class="font-medium text-red-700">Unfortunately, your application was rejected.</p>
                        @if ($form->rejection && $form->rejection->remark)
                            <p class="mt-2 text-sm text-red-600">
                                <strong>Reason:</strong> {{ $form->rejection->remark }}
                            </p>
                        @endif
                    </div>

                @elseif ($form->status === 'Assigned')
                    <div class="p-6 bg-green-50 border border-green-300 rounded-lg text-center">
                        <i class="fa-solid fa-scale-balanced text-green-600 text-3xl mb-3"></i>
                        <p class="font-medium text-green-700 mb-3">A lawyer has been assigned to your case.</p>

                        @if ($form->panelLawyer)
                            <div
                                class="bg-white border border-green-200 rounded-lg shadow-sm p-4 text-left inline-block text-sm">
                                <p><strong>Lawyer Name:</strong> {{ $form->panelLawyer->first_name }} {{ $form->panelLawyer->last_name }}</p>
                                <p><strong>Contact:</strong> {{ $form->panelLawyer->contact_number ?? 'N/A' }}</p>
                                <p><strong>Email:</strong> {{ $form->panelLawyer->email ?? 'N/A' }}</p>
                            </div>
                        @else
                            <p class="text-gray-600 text-sm italic">Lawyer details will be updated soon.</p>
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
