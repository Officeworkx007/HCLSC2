<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Contact | High Court Legal Services Committee</title>

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        .page-frame {
            background: #ffffff;
            border-radius: 18px;
            max-width: 1050px;
            margin: 1.5rem auto;
            padding: 1.5rem;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        @media (min-width: 768px) {
            .page-frame {
                margin: 3rem auto;
                padding: 3rem;
            }
        }

        .card-divider {
            border-top: 1px solid rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col bg-gray-100">

    <!-- ✅ HEADER INCLUDE -->
    <header class="w-full">
        @include('homepage.layouts.header')
    </header>

    <!-- PAGE CONTENT -->
    <main class="flex-grow w-full flex items-start justify-center py-6 px-3 sm:px-4">
        <div class="page-frame w-full">
            @if (session('success'))
                <div id="alert-message"
                    class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 text-sm rounded-md">
                    <i class="fa-solid fa-circle-check mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-start md:gap-8 mb-8">
                <div class="md:w-1/2">
                    <h1
                        class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 leading-tight">
                        CONTACT US
                    </h1>
                </div>

                <div class="md:w-1/2 mt-4 md:mt-0 text-justify">
                    <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
                        If you have any questions regarding legal aid, free legal assistance, or services provided by
                        the
                        <span class="font-semibold text-gray-800">High Court Legal Services Committee</span>,
                        please feel free to reach out to us via phone, email, or by filling out the contact form below.
                    </p>
                </div>
            </div>

            <!-- Main Content: Left form, right info -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Left: Form -->
                <div class="lg:col-span-7">
                    <div class="bg-gray-50 rounded-lg shadow-sm p-5 sm:p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">GET IN TOUCH</h3>

                        <form action="{{ route('homepage.contactus.store') }}" method="POST" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-2">NAME</label>
                                    <input name="name" value="{{ old('name') }}" type="text"
                                        placeholder="Enter your name*"
                                        class="w-full rounded-md border border-gray-200 px-4 py-2 bg-white text-gray-700 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
                                    @error('name')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-2">PHONE NUMBER</label>
                                    <input name="phone" value="{{ old('phone') }}" type="text"
                                        placeholder="Enter your phone number*"
                                        class="w-full rounded-md border border-gray-200 px-4 py-2 bg-white text-gray-700 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
                                    @error('phone')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-2">EMAIL</label>
                                <input name="email" value="{{ old('email') }}" type="email"
                                    placeholder="Enter your email*"
                                    class="w-full rounded-md border border-gray-200 px-4 py-2 bg-white text-gray-700 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
                                @error('email')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-2">YOUR MESSAGE</label>
                                <textarea name="message" rows="5" placeholder="Write your message here..."
                                    class="w-full rounded-md border border-gray-200 px-4 py-3 bg-white text-gray-700 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                    class="inline-block w-full sm:w-auto text-center px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    SEND MESSAGE
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right: Contact Information -->
                <div class="lg:col-span-5 flex flex-col gap-6">

                    <!-- Contact Information -->
                    <div class="bg-gray-50 rounded-lg p-5 sm:p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">CONTACT INFORMATION</h3>
                        <div class="card-divider pt-4 pb-4 mb-4"></div>

                        <div class="space-y-5">
                            <div class="flex items-start gap-4">
                                <div class="p-3 rounded-full bg-white border border-gray-100 flex-shrink-0">
                                    <i class="fa-solid fa-phone text-blue-700"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-semibold text-gray-600">HELPLINE</div>
                                    <div class="text-sm text-gray-700 mt-1">6009904973</div>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="p-3 rounded-full bg-white border border-gray-100 flex-shrink-0">
                                    <i class="fa-solid fa-envelope text-blue-700"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-semibold text-gray-600">EMAIL</div>
                                    <div class="text-sm text-gray-700 mt-1 break-all">hclscman@gmail.com</div>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="p-3 rounded-full bg-white border border-gray-100 flex-shrink-0">
                                    <i class="fa-solid fa-location-dot text-blue-700"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-semibold text-gray-600">ADDRESS</div>
                                    <div class="text-sm text-gray-700 mt-1 leading-relaxed">
                                        High Court Legal Services Committee,<br>
                                        High Court Complex, Mantripukhri,<br>
                                        Imphal, Manipur - 795002
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Office Hours -->
                    <div class="bg-gray-50 rounded-lg p-5 sm:p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">OFFICE HOURS</h3>
                        <div class="card-divider pt-4 mb-4"></div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                            <div>
                                <div class="text-xs font-semibold text-gray-800">MONDAY - FRIDAY</div>
                                <div class="mt-1">10:00 am - 4:30 pm</div>
                            </div>
                            <div>
                                <div class="text-xs font-semibold text-gray-800">1st & 3rd SATURDAY</div>
                                <div class="mt-1">10:00 am - 4:30 pm</div>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="text-xs font-semibold text-gray-800">2nd & 4th SATURDAY & SUNDAY</div>
                                <div class="mt-1">OFF</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="mt-10 bg-white rounded-lg overflow-hidden shadow-lg">
                <div class="h-64 sm:h-72 md:h-96 w-full">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3586.119037553904!2d93.93998387592153!3d24.836700946206804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3749279c702e88d3%3A0x9c60a52603ac5f9d!2sHigh%20Court%20Complex%2C%20Mantripukhri%2C%20Chingmeirong%2C%20Imphal%2C%20Heingang%2C%20Manipur%20795001!5e0!3m2!1sen!2sin!4v1760680143956!5m2!1sen!2sin"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="w-full h-full rounded-lg"></iframe>
                </div>
            </div>

            <!-- Footer Credit -->
            <div class="mt-8 text-center text-gray-400 text-sm">
                © {{ date('Y') }} High Court Legal Services Committee. All rights reserved.
            </div>
        </div>
    </main>

    <!-- ✅ FOOTER INCLUDE -->
    <footer class="w-full mt-8">
        @include('homepage.layouts.footer')
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alertBox = document.getElementById('alert-message');
            if (alertBox) {
                setTimeout(() => {
                    alertBox.style.transition = "opacity 0.5s ease";
                    alertBox.style.opacity = "0";

                    setTimeout(() => alertBox.remove(), 500); // remove from DOM
                }, 3000); // show for 3 seconds
            }
        });
    </script>

</body>

</html>
