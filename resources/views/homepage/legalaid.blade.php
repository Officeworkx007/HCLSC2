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
    @include('homepage.header')

    <!-- Main content grows to fill space -->
    <main class="flex-grow flex justify-center py-6">
        <div class="w-full max-w-4xl bg-white shadow-md rounded-lg mx-auto">

            <!--Header-->
            <div id="toggleBtn"
                class="flex justify-between items-center bg-gray-800 text-white px-6 py-3 cursor-pointer rounded-t-lg">
                <h2 class="text-lg font-semibold">Personal Details</h2>
                <span id="toggleIcon" class="text-2xl font-bold">+</span>
            </div>
            <!--Collapsible Form-->
            <div id="formContainer" class="hidden px-6 py-4">
                <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium mb-1">Applicant Name * </label>
                        <input type="text" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                            placeholder="Enter Name" id="name">
                    </div>
                    <div>
                        <label for="father_name" class="block text-sm font-medium mb-1">Father Name</label>
                        <input type="text" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                            placeholder="Enter Fathers Name" id="father_name">
                    </div>
                    <div>
                        <label for="mother_name" class="block text-sm font-medium mb-1">Mother Name</label>
                        <input type="text" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                            placeholder="Enter Mothers Name" id="mother_name">
                    </div>
                    <div>
                        <label for="spouse_name" class="block text-sm font-medium mb-1">Spouse Name</label>
                        <input type="text" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                            placeholder="Enter Spouse Name" id="spouse_name">
                    </div>
                    <div>
                        <label for="photo" class="block text-sm font-medium mb-1">Upload Photograph</label>
                        <input type="file" accept="image/*"
                            class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300 cursor-pointer" id="photo">
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium mb-1">Gender</label>
                        <select name="gender" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300" id="gender">
                            <option value="">-- Select Gender --</option>
                            @foreach ($genders as $gender)
                                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="number" class="block text-sm font-medium mb-1">Phone Number</label>
                        <input type="number" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300" id="number" placeholder="Enter Phone Number">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Email</label>
                        <input type="text" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300" id="email" placeholder="Enter Email Address">
                    </div>
                </form>
            </div>
        </div>
    </main>

    @include('homepage.footer')

    <!-- Script -->
    <script>
        const toggleBtn = document.getElementById("toggleBtn");
        const formContainer = document.getElementById("formContainer");
        const toggleIcon = document.getElementById("toggleIcon");

        toggleBtn.addEventListener("click", () => {
            formContainer.classList.toggle("hidden");
            toggleIcon.textContent = formContainer.classList.contains("hidden") ? "+" : "-";
        });
    </script>
</body>
