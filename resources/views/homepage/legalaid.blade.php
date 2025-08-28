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
                        <label class="block text-sm font-medium mb-1">Applicant Name * </label>
                        <input type="text" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                            placeholder="Enter Name">
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
