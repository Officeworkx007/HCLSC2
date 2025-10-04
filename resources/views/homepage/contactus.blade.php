<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Contact Us</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <!-- jQuery then DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">
    @include('homepage.layouts.header')

    <!-- Hero Section -->
    <section
        class="bg-cover bg-center bg[url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1470&q=80')] h-48 flex items-center justify-center relative">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative text-center text-white">
            <h1 class="text-3xl font-semibold">Contact Us</h1>
        </div>
    </section>

    <!-- Contact Info & Form -->
    <section class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-12">

        <!-- Left Info -->
        <div>
            <h2 class="text-2xl font-semibold mb-4">Always Here to Help You</h2>
            <p class="text-gray-600 mb-8">There are many variations of passages of Lorem Ipsum available, but the
                majority have suffered alteration in some form, by injected humor, or randomized words which don't look
                even slightly believable.</p>

            <div class="space-y-6">
                <!-- Location -->
                <div class="flex items-start gap-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fa-solid fa-location-dot text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Location</h4>
                        <p>4517 Washington Ave. Manchester, Kentucky 39495</p>
                    </div>
                </div>

                <!-- Contact -->
                <div class="flex items-start gap-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fa-solid fa-phone text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Contact</h4>
                        <p>(603) 555-0128<br>(603) 555-0123</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start gap-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fa-solid fa-envelope text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Email</h4>
                        <p>support@thefork.com</p>
                    </div>
                </div>

                <!-- Hours -->
                <div class="flex items-start gap-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fa-solid fa-clock text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Hours of Operation</h4>
                        <p>Monday - Friday: 09.00 - 20.00<br>Sunday & Saturday: 10.30 - 22.30</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Form -->
        <div class="bg-white p-8 shadow-md rounded-2xl">
            <h3 class="text-xl font-semibold mb-6">Ready To Get Started?</h3>
            <form class="space-y-4">
                <input type="text" placeholder="John Doe"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="email" placeholder="Email"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="tel" placeholder="Enter number"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <textarea placeholder="Write a message..." rows="4"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" class="accent-blue-600">
                    Accept <a href="#" class="text-blue-600 underline">terms</a> and <a href="#"
                        class="text-blue-600 underline">privacy policy</a>.
                </label>

                <button type="submit"
                    class="w-full bg-blue-900 text-white py-3 rounded-lg hover:bg-blue-800 transition-all">Send
                    Message</button>
            </form>
        </div>

    </section>

    <!-- Google Map -->
    <section class="px-6 pb-12">
        <div class="max-w-7xl mx-auto">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3312.689370783871!2d-118.24368318478857!3d34.05223448060524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c7b8f32f7d19%3A0xc16e0cce4425bc5!2sCalifornia!5e0!3m2!1sen!2sus!4v1615372488455!5m2!1sen!2sus"
                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a2e0e6ad52.js" crossorigin="anonymous"></script>

    @include('homepage.layouts.footer')
</body>
