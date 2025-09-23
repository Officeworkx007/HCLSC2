<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High Court Legal Services Committee, Manipur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Heroicons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">
    @include('homepage.layouts.header')

    <div class="min-h-screen flex flex-col items-center py-8 px-4 w-full">

        {{-- Flash Success Message --}}
        @if (session('success'))
            <div id="successMessage" class="bg-green-100 text-green-800 p-3 rounded mb-4 w-full max-w-2xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- Token Message --}}
        @if (session('token_number'))
            <div id="tokenMessage" class="bg-blue-100 text-blue-800 p-3 rounded mb-4 w-full max-w-2xl flex justify-between items-center">
                <span>Your Token Number: <strong>{{ session('token_number') }}</strong></span>
                <button onclick="document.getElementById('tokenMessage').remove()" class="ml-4 text-red-600 font-bold">X</button>
            </div>
        @endif

        {{-- Manual Search Form --}}
        <div class="bg-white shadow-md rounded p-6 w-full max-w-2xl mb-6">
            <h2 class="text-xl font-semibold mb-4">Track Your Application</h2>
            <form action="" method="GET" class="space-y-4" onsubmit="return submitTrackForm(this)">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="token" placeholder="Enter Token Number" class="border rounded px-3 py-2 w-full" required>
                    <input type="text" name="name" placeholder="Enter Applicant Name" class="border rounded px-3 py-2 w-full" required>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Track</button>
            </form>
        </div>

        {{-- Error Message --}}
        @if (isset($error))
            <div class="bg-red-100 text-red-700 p-3 rounded w-full max-w-2xl mb-4">
                {{ $error }}
            </div>
        @endif

        {{-- Show Applicant Details --}}
        @if (isset($form) && $form)
            <div class="bg-white shadow-md rounded p-6 w-full max-w-2xl mb-6">
                <h3 class="text-lg font-semibold mb-4">Application Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <p><strong>Name:</strong> {{ $form->name }}</p>
                    <p><strong>Token Number:</strong> {{ $form->token_number }}</p>
                    <p><strong>Father Name:</strong> {{ $form->father_name }}</p>
                    <p><strong>Mother Name:</strong> {{ $form->mother_name }}</p>
                    <p><strong>Spouse Name:</strong> {{ $form->spouse_name }}</p>
                    <p><strong>Phone Number:</strong> {{ $form->number }}</p>
                    <p><strong>Email:</strong> {{ $form->email }}</p>
                    <p><strong>Gender:</strong> {{ $form->gender->name ?? '-' }}</p>
                    <p><strong>Religion:</strong> {{ $form->religion->name ?? '-' }}</p>
                    <p><strong>Caste:</strong> {{ $form->caste->name ?? '-' }}</p>
                    <p><strong>Caste Certificate No:</strong> {{ $form->certificate_no }}</p>
                    <p><strong>Occupation:</strong> {{ $form->occupation->name ?? '-' }}</p>
                    <p><strong>Employment Details:</strong> {{ $form->employment_details }}</p>
                    <p><strong>Annual Income:</strong> {{ $form->income->name ?? '-' }}</p>
                    <p><strong>Eligibility Category:</strong> {{ $form->eligibility_category->name ?? '-' }}</p>
                </div>
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

        // Handle dynamic form action for manual tracking
        function submitTrackForm(form) {
            const token = form.token.value.trim();
            if (!token) return false;
            form.action = `/homepage/track/${token}`;
            return true;
        }
    </script>
</body>
