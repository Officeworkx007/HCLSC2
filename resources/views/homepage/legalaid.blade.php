<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High Court Legal Services Committee, Manipur</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Fluid container for all devices */
        .page-container {
            width: 95%;
            max-width: 1100px;
            margin: auto;
        }

        /* Adjust form spacing for better readability on small screens */
        form label {
            font-weight: 500;
        }

        /* Smooth transitions for collapsible sections */
        .collapsible {
            transition: all 0.3s ease-in-out;
        }

        /* Highlight validation errors */
        .is-invalid {
            border-color: #ef4444; /* Tailwind red-500 */
        }

        /* Prevent text overflow on smaller devices */
        input,
        select {
            word-break: break-word;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">
    @include('homepage.layouts.header')

    <form action="{{ route('homepage.legalaid.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <section class="flex justify-center py-6">
            <div class="page-container bg-white shadow-lg rounded-xl overflow-hidden">

                <div id="toggleBtn1"
                    class="flex justify-between items-center bg-blue-900 text-white px-6 py-3 cursor-pointer">
                    <h2 class="text-lg font-semibold">Personal Details</h2>
                    <span id="toggleIcon1" class="text-2xl font-bold">-</span>
                </div>

                <div id="formContainer1" class="collapsible px-6 py-6 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        {{-- Applicant Name --}}
                        <div>
                            <label for="name" class="block text-sm mb-1">Applicant Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name') }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('name') is-invalid @enderror"
                                placeholder="Enter Name">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Father Name --}}
                        <div>
                            <label for="father_name" class="block text-sm mb-1">Father Name</label>
                            <input type="text" name="father_name" id="father_name"
                                value="{{ old('father_name') }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('father_name') is-invalid @enderror"
                                placeholder="Enter Father's Name">
                            @error('father_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Mother Name --}}
                        <div>
                            <label for="mother_name" class="block text-sm mb-1">Mother Name</label>
                            <input type="text" name="mother_name" id="mother_name"
                                value="{{ old('mother_name') }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('mother_name') is-invalid @enderror"
                                placeholder="Enter Mother's Name">
                            @error('mother_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Marital Status --}}
                        <div>
                            <label for="marital_status" class="block text-sm mb-1">Marital Status <span class="text-red-500">*</span></label>
                            <div class="flex gap-4 mt-2 @error('marital_status') is-invalid @enderror">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="marital_status" value="1"
                                        class="form-radio h-4 w-4 text-blue-600" id="marriedYes"
                                        {{ old('marital_status') === '1' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Married</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="marital_status" value="0"
                                        class="form-radio h-4 w-4 text-blue-600" id="marriedNo"
                                        {{ old('marital_status') === '0' || old('marital_status') === null ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Unmarried/Divorced/Widowed</span>
                                </label>
                            </div>
                            @error('marital_status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Spouse Name Field (Dynamically hidden/shown) --}}
                        {{-- Added @error class to container to force show if validation fails --}}
                        <div id="spouseNameContainer" class="{{ old('marital_status') === '1' || $errors->has('spouse_name') ? '' : 'hidden' }}">
                            <label for="spouse_name" class="block text-sm mb-1">Spouse Name
                                <span class="spouse-required-indicator text-red-500 {{ old('marital_status') === '1' ? '' : 'hidden' }}">*</span>
                            </label>
                            <input type="text" name="spouse_name" id="spouse_name"
                                value="{{ old('spouse_name') }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('spouse_name') is-invalid @enderror"
                                placeholder="Enter Spouse Name (Required if Married)">
                            @error('spouse_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Upload Photograph --}}
                        <div>
                            <label for="photo" class="block text-sm mb-1">Upload Photograph</label>
                            <input type="file" name="photo" id="photo" accept="image/*"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 cursor-pointer @error('photo') is-invalid @enderror">
                            @error('photo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Gender --}}
                        <div>
                            <label for="gender" class="block text-sm mb-1">Gender <span class="text-red-500">*</span></label>
                            <select name="gender" id="gender"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('gender') is-invalid @enderror">
                                <option value="">-- Select Gender --</option>
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender->id }}"
                                        {{ old('gender') == $gender->id ? 'selected' : '' }}>{{ $gender->name }}</option>
                                @endforeach
                            </select>
                            @error('gender')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Phone Number --}}
                        <div>
                            <label for="number" class="block text-sm mb-1">Phone Number <span class="text-red-500">*</span></label>
                            <input type="text" name="number" id="number"
                                value="{{ old('number') }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('number') is-invalid @enderror"
                                placeholder="Enter Phone Number">
                            @error('number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm mb-1">Email</label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email') }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('email') is-invalid @enderror"
                                placeholder="Enter Email Address">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Religion --}}
                        <div>
                            <label for="religion" class="block text-sm mb-1">Religion <span class="text-red-500">*</span></label>
                            <select name="religion" id="religion"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('religion') is-invalid @enderror">
                                <option value="">-- Select Religion --</option>
                                @foreach ($religions as $religion)
                                    <option value="{{ $religion->id }}"
                                        {{ old('religion') == $religion->id ? 'selected' : '' }}>{{ $religion->name }}</option>
                                @endforeach
                            </select>
                            @error('religion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Caste --}}
                        <div>
                            <label for="caste" class="block text-sm mb-1">Caste <span class="text-red-500">*</span></label>
                            <select name="caste" id="caste"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('caste') is-invalid @enderror">
                                <option value="">-- Select Caste --</option>
                                @foreach ($castes as $caste)
                                    <option value="{{ $caste->id }}"
                                        {{ old('caste') == $caste->id ? 'selected' : '' }}>{{ $caste->name }}</option>
                                @endforeach
                            </select>
                            @error('caste')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Caste Certificate No --}}
                        <div>
                            <label for="certificate_no" class="block text-sm mb-1">Caste Certificate No</label>
                            <input type="text" name="certificate_no" id="certificate_no"
                                value="{{ old('certificate_no') }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('certificate_no') is-invalid @enderror"
                                placeholder="Enter Certificate Number">
                            @error('certificate_no')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Occupation --}}
                        <div>
                            <label for="occupation" class="block text-sm mb-1">Occupation <span class="text-red-500">*</span></label>
                            <select name="occupation" id="occupation"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('occupation') is-invalid @enderror">
                                <option value="">-- Select Occupation --</option>
                                @foreach ($occupations as $occupation)
                                    <option value="{{ $occupation->id }}"
                                        {{ old('occupation') == $occupation->id ? 'selected' : '' }}>{{ $occupation->name }}</option>
                                @endforeach
                            </select>
                            @error('occupation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Employment Details --}}
                        <div>
                            <label for="employment_details" class="block text-sm mb-1">Employment</label>
                            <input type="text" name="employment_details" id="employment_details"
                                value="{{ old('employment_details') }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('employment_details') is-invalid @enderror"
                                placeholder="Enter Employment Details">
                            @error('employment_details')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Annual Income --}}
                        <div>
                            <label for="income" class="block text-sm mb-1">Annual Income <span class="text-red-500">*</span></label>
                            <select name="income" id="income"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('income') is-invalid @enderror">
                                <option value="">-- Select Income --</option>
                                @foreach ($incomes as $income)
                                    <option value="{{ $income->id }}"
                                        {{ old('income') == $income->id ? 'selected' : '' }}>{{ $income->name }}</option>
                                @endforeach
                            </select>
                            @error('income')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Eligibility Category --}}
                        <div>
                            <label for="eligibility_category" class="block text-sm mb-1">Eligibility Category <span class="text-red-500">*</span></label>
                            <select name="eligibility_category" id="eligibility_category"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('eligibility_category') is-invalid @enderror">
                                <option value="">-- Select Eligibility Category --</option>
                                @foreach ($eligibilities as $eligibility)
                                    <option value="{{ $eligibility->id }}"
                                        {{ old('eligibility_category') == $eligibility->id ? 'selected' : '' }}>{{ $eligibility->name }}</option>
                                @endforeach
                            </select>
                            @error('eligibility_category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="flex justify-center py-6">
            <div class="page-container bg-white shadow-lg rounded-xl overflow-hidden">

                <div id="toggleBtn2"
                    class="flex justify-between items-center bg-blue-900 text-white px-6 py-3 cursor-pointer">
                    <h2 class="text-lg font-semibold">Attach Document</h2>
                    <span id="toggleIcon2" class="text-2xl font-bold">+</span>
                </div>

                {{-- Force container visible if document upload validation failed --}}
                <div id="formContainer2" class="collapsible px-6 py-6 space-y-6 {{ $errors->has('upload_documents.*') || $errors->has('document_files.*') || old('upload_documents') ? '' : 'hidden' }}">
                    <div id="documentsWrapper" class="space-y-6">

                        @php
                            // Determine how many document rows to show
                            $oldDocuments = old('upload_documents') ?: [null];
                        @endphp

                        @foreach ($oldDocuments as $index => $oldDocumentId)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center single-doc-row">
                                {{-- Document Type Select --}}
                                <div>
                                    <label class="block text-sm mb-1">Upload Document</label>
                                    <select name="upload_documents[]"
                                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 @error('upload_documents.' . $index) is-invalid @enderror">
                                        <option value="">--Select File--</option>
                                        @foreach ($documents as $document)
                                            <option value="{{ $document->id }}"
                                                {{ old("upload_documents.{$index}") == $document->id ? 'selected' : '' }}>
                                                {{ $document->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('upload_documents.' . $index)
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- File Input and Delete Button --}}
                                <div class="flex gap-3 items-center">
                                    <input type="file" name="document_files[]" accept="image/*,.pdf"
                                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 cursor-pointer @error('document_files.' . $index) is-invalid @enderror">
                                    <button type="button"
                                        class="delete-row bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700">X</button>
                                </div>
                                @error('document_files.' . $index)
                                    <p class="text-red-500 text-xs mt-1 sm:col-span-2">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach

                    </div>

                    <div>
                        <button type="button" id="addMoreDocs"
                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">+ Add More</button>
                    </div>
                </div>
            </div>
        </section>

        <div class="flex justify-center py-10">
            <button type="submit"
                class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-3 rounded-lg shadow-md transition">
                Submit Application
            </button>
        </div>
    </form>

    @include('homepage.layouts.footer')

    <script>
        // Collapsible Section Toggle
        const toggleSection = (btnId, formId, iconId) => {
            const btn = document.getElementById(btnId);
            const form = document.getElementById(formId);
            const icon = document.getElementById(iconId);
            btn.addEventListener('click', () => {
                const isHidden = form.classList.toggle('hidden');
                icon.textContent = isHidden ? '+' : '-';
            });
        };

        // Initialize only if the form container is not being forced open by validation errors
        if (document.getElementById('formContainer1').classList.contains('hidden')) {
            toggleSection('toggleBtn1', 'formContainer1', 'toggleIcon1');
        } else {
             document.getElementById('toggleIcon1').textContent = '-';
        }

        if (document.getElementById('formContainer2').classList.contains('hidden')) {
            toggleSection('toggleBtn2', 'formContainer2', 'toggleIcon2');
        } else {
            document.getElementById('toggleIcon2').textContent = '-';
        }

        // Dynamic Document Rows
        document.addEventListener("DOMContentLoaded", function() {
            const addMoreBtn = document.getElementById("addMoreDocs");
            const wrapper = document.getElementById("documentsWrapper");
            const documentSelectOptions = wrapper.querySelector("select").innerHTML; // Cache options for new rows

            addMoreBtn.addEventListener("click", function() {
                // Template for a new row
                const newRowHTML = `
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center single-doc-row">
                        <div>
                            <label class="block text-sm mb-1">Upload Document</label>
                            <select name="upload_documents[]"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                                ${documentSelectOptions}
                            </select>
                        </div>
                        <div class="flex gap-3 items-center">
                            <input type="file" name="document_files[]" accept="image/*,.pdf"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 cursor-pointer">
                            <button type="button"
                                class="delete-row bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700">X</button>
                        </div>
                    </div>
                `;
                wrapper.insertAdjacentHTML('beforeend', newRowHTML);
            });

            // Delete row logic
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

        // Spouse section for collapsible
        document.addEventListener("DOMContentLoaded", function() {
            const marriedYes = document.getElementById('marriedYes');
            const marriedNo = document.getElementById('marriedNo');
            const spouseNameContainer = document.getElementById('spouseNameContainer');
            const spouseNameInput = document.getElementById('spouse_name');
            const spouseRequiredIndicator = document.querySelector('.spouse-required-indicator');

            // Function to handle the visibility toggle and requirement
            const toggleSpouseNameField = () => {
                if (marriedYes.checked) {
                    spouseNameContainer.classList.remove('hidden');
                    spouseRequiredIndicator.classList.remove('hidden');
                    spouseNameInput.setAttribute('required', 'required'); // Client-side required
                } else {
                    // Check if validation error is forcing it to stay open, if not, hide it
                    if (!spouseNameContainer.classList.contains('is-invalid') && !document.querySelector('.is-invalid')) {
                         spouseNameContainer.classList.add('hidden');
                    }
                    spouseRequiredIndicator.classList.add('hidden');
                    spouseNameInput.removeAttribute('required');
                    // Only clear the field if it was successfully unmarried/not selected on server
                    if (!spouseNameContainer.classList.contains('is-invalid')) {
                         spouseNameInput.value = '';
                    }
                }
            };

            // Listen for changes on both radio buttons
            marriedYes.addEventListener('change', toggleSpouseNameField);
            marriedNo.addEventListener('change', toggleSpouseNameField);

            // Initial check (handles both default state and old input retention)
            toggleSpouseNameField();
        });
    </script>
</body>

</html>
