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

    <!-- Single Form Wrapper -->
    <form action="{{ route('homepage.legalaid.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Personal Details Section -->
        <main class="flex-grow flex justify-center py-6">
            <div class="w-full max-w-4xl bg-white shadow-md rounded-lg mx-auto">

                <!--Header-->
                <div id="toggleBtn1"
                    class="flex justify-between items-center bg-gray-800 text-white px-6 py-3 cursor-pointer rounded-t-lg">
                    <h2 class="text-lg font-semibold">Personal Details</h2>
                    <span id="toggleIcon1" class="text-2xl font-bold">-</span>
                </div>

                <!--Collapsible Form-->
                <div id="formContainer1" class="px-6 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium mb-1">Applicant Name * </label>
                            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                                placeholder="Enter Name">
                        </div>
                        <div>
                            <label for="father_name" class="block text-sm font-medium mb-1">Father Name</label>
                            <input type="text" name="father_name" id="father_name" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                                placeholder="Enter Fathers Name">
                        </div>
                        <div>
                            <label for="mother_name" class="block text-sm font-medium mb-1">Mother Name</label>
                            <input type="text" name="mother_name" id="mother_name" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                                placeholder="Enter Mothers Name">
                        </div>
                        <div>
                            <label for="spouse_name" class="block text-sm font-medium mb-1">Spouse Name</label>
                            <input type="text" name="spouse_name" id="spouse_name" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                                placeholder="Enter Spouse Name">
                        </div>
                        <div>
                            <label for="photo" class="block text-sm font-medium mb-1">Upload Photograph</label>
                            <input type="file" name="photo" id="photo" accept="image/*"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300 cursor-pointer">
                        </div>
                        <div>
                            <label for="gender" class="block text-sm font-medium mb-1">Gender</label>
                            <select name="gender" id="gender" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
                                <option value="">-- Select Gender --</option>
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="number" class="block text-sm font-medium mb-1">Phone Number</label>
                            <input type="text" name="number" id="number" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                                placeholder="Enter Phone Number">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium mb-1">Email</label>
                            <input type="text" name="email" id="email" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                                placeholder="Enter Email Address">
                        </div>
                        <div>
                            <label for="religion" class="block text-sm font-medium mb-1">Religion</label>
                            <select name="religion" id="religion" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
                                <option value="">-- Select Religion --</option>
                                @foreach ($religions as $religion)
                                    <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="caste" class="block text-sm font-medium mb-1">Caste</label>
                            <select name="caste" id="caste" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
                                <option value="">-- Select Caste --</option>
                                @foreach ($castes as $caste)
                                    <option value="{{ $caste->id }}">{{ $caste->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="certificate_no" class="block text-sm font-medium mb-1">Caste Certificate No</label>
                            <input type="text" name="certificate_no" id="certificate_no" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                                placeholder="Enter Caste Certificate Number">
                        </div>
                        <div>
                            <label for="occupation" class="block text-sm font-medium mb-1">Occupation</label>
                            <select name="occupation" id="occupation" class="w-full border rounded px-6 py-2 focus:ring focus:ring-blue-300">
                                <option value="">-- Select Occupation --</option>
                                @foreach ($occupations as $occupation)
                                    <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="employment_details" class="block text-sm font-medium mb-1">Employment</label>
                            <input type="text" name="employment_details" id="employment_details" class="w-full border rounded px-6 py-2 focus:ring focus:ring-blue-300"
                                placeholder="Enter Employment Details">
                        </div>
                        <div>
                            <label for="income" class="block text-sm font-medium mb-1">Annual Income</label>
                            <select name="income" id="income" class="w-full border rounded px-6 py-2 focus:ring focus:ring-blue-300">
                                <option value="">-- Select Income --</option>
                                @foreach ($incomes as $income)
                                    <option value="{{ $income->id }}">{{ $income->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="eligibility_category" class="block text-sm font-medium mb-1">Eligibility Category</label>
                            <select name="eligibility_category" id="eligibility_category" class="w-full border rounded px-6 py-2 focus:ring focus:ring-blue-300">
                                <option value="">--Select Eligibility Category --</option>
                                @foreach ($eligibilities as $eligibility)
                                    <option value="{{ $eligibility->id }}">{{ $eligibility->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Attach Document Section -->
        <main class="flex-grow flex justify-center py-6">
            <div class="w-full max-w-4xl bg-white shadow-md rounded-lg mx-auto">

                <!--Header-->
                <div id="toggleBtn2"
                    class="flex justify-between items-center bg-gray-800 text-white px-6 py-3 cursor-pointer rounded-t-lg">
                    <h2 class="text-lg font-semibold">Attach Document</h2>
                    <span id="toggleIcon2" class="text-2xl font-bold">+</span>
                </div>

                <!--Collapsible Form-->
                <div id="formContainer2" class="hidden px-6 py-4">
                    <div id="documentsWrapper">
                        <!-- First Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center single-doc-row">
                            <div>
                                <label for="upload_documents" class="block text-sm font-medium mb-1">Upload Document</label>
                                <select name="upload_documents[]" class="w-full border rounded px-6 py-2 focus:ring focus:ring-blue-300">
                                    <option value="">--Select File--</option>
                                    @foreach ($documents as $document)
                                        <option value="{{ $document->id }}">{{ $document->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex gap-2 items-center">
                                <input type="file" name="document_files[]" accept="image/*,.pdf"
                                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300 cursor-pointer">
                                <button type="button" class="delete-row bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700">X</button>
                            </div>
                        </div>
                    </div>

                    <!-- Add More Button -->
                    <div class="mt-4">
                        <button type="button" id="addMoreDocs"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add More</button>
                    </div>
                </div>
            </div>
        </main>

        <!-- Submit Button -->
        <div class="flex justify-center py-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Submit
            </button>
        </div>
    </form>

    @include('homepage.footer')

    <!-- Script -->
    <script>
        // Collapsible sections
        const toggleBtn1 = document.getElementById("toggleBtn1");
        const formContainer1 = document.getElementById("formContainer1");
        const toggleIcon1 = document.getElementById("toggleIcon1");

        toggleBtn1.addEventListener("click", () => {
            formContainer1.classList.toggle("hidden");
            toggleIcon1.textContent = formContainer1.classList.contains("hidden") ? "+" : "-";
        });

        const toggleBtn2 = document.getElementById("toggleBtn2");
        const formContainer2 = document.getElementById("formContainer2");
        const toggleIcon2 = document.getElementById("toggleIcon2");

        toggleBtn2.addEventListener("click", () => {
            formContainer2.classList.toggle("hidden");
            toggleIcon2.textContent = formContainer2.classList.contains("hidden") ? "+" : "-";
        });

        document.addEventListener("DOMContentLoaded", function() {
            const addMoreBtn = document.getElementById("addMoreDocs");
            const wrapper = document.getElementById("documentsWrapper");

            // Add new row
            addMoreBtn.addEventListener("click", function() {
                const newRow = wrapper.querySelector(".single-doc-row").cloneNode(true);
                newRow.querySelector("select").selectedIndex = 0;
                newRow.querySelector("input[type='file']").value = "";
                wrapper.appendChild(newRow);
            });

            // Delete row (event delegation)
            wrapper.addEventListener("click", function(e) {
                if (e.target.classList.contains("delete-row")) {
                    const rows = wrapper.querySelectorAll(".single-doc-row");
                    if (rows.length > 1) {
                        e.target.closest(".single-doc-row").remove();
                    } else {
                        alert("At least one document field is required.");
                    }
                }
            });
        });
    </script>
</body>
