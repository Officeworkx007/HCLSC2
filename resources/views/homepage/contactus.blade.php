<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Contact | HCLSC</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    /* Decorative Manipur overlay background */
    .manipur-overlay {
      background-image: url('/images/manipur.png'); /* 🟦 Replace with your actual map image */
      background-repeat: no-repeat;
      background-position: center center; /* Center the map image */
      background-size: 55%; /* Make it more prominent */
      position: relative;
      min-height: 450px; /* Increase the visual height of the section */
    }

    /* Blue gradient overlay layer */
    .manipur-overlay::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(9, 10, 12, 0.9) 0%, rgba(6, 8, 10, 0.95) 100%);
      z-index: 0;
    }

    /* Floating form + map card styling */
    .floating-card {
      box-shadow: 0 30px 60px rgba(2,6,23,0.45);
      border: 1px solid rgba(255,255,255,0.06);
      backdrop-filter: blur(6px);
      border-radius: 1.5rem;
      overflow: hidden;
      background-color: white;
    }

    @media (min-width: 768px) {
      .floating-container {
        margin-top: -7rem; /* pulls card above blue section */
      }
    }

    /* Smooth gradient transition into gray footer */
    .transition-band {
      height: 40px;
      background: linear-gradient(180deg, rgba(6,8,10,0.95) 0%, #f4f4f4 100%);
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Optional header -->
  <!-- @include('homepage.layouts.header') -->

  <!-- Spacer for header -->
  <div class="h-24 md:h-32"></div>

  <!-- Floating Card (Map + Contact Form) -->
  <div class="max-w-6xl mx-auto px-6 relative z-30 floating-container">
    <div class="floating-card md:flex">
      <!-- Left: Map -->
      <div class="md:w-1/2 w-full h-80 md:h-auto">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4294.978872691813!2d93.93998387592151!3d24.83670094620681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3749279c702e88d3%3A0x9c60a52603ac5f9d!2sHigh%20Court%20Complex%2C%20Mantripukhri%2C%20Imphal%2C%20Heingang%2C%20Manipur%20795001!5e1!3m2!1sen!2sin!4v1759728398906!5m2!1sen!2sin"
          class="w-full h-full border-0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <!-- Right: Contact Form -->
      <div class="md:w-1/2 w-full p-8 md:p-10">
        <h2 class="text-2xl font-semibold mb-2">Our cybersecurity experts are ready to help.</h2>
        <p class="text-sm text-gray-500 mb-6">Fill out the form and we'll get in touch with you.</p>

        <form class="space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <input type="text" placeholder="First name"
                   class="p-3 border border-gray-200 rounded-md focus:ring-2 focus:ring-blue-600 outline-none">
            <input type="text" placeholder="Last name"
                   class="p-3 border border-gray-200 rounded-md focus:ring-2 focus:ring-blue-600 outline-none">
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <input type="email" placeholder="Email address"
                   class="p-3 border border-gray-200 rounded-md focus:ring-2 focus:ring-blue-600 outline-none">
            <input type="tel" placeholder="Phone number"
                   class="p-3 border border-gray-200 rounded-md focus:ring-2 focus:ring-blue-600 outline-none">
          </div>

          <input type="text" placeholder="Company name"
                 class="w-full p-3 border border-gray-200 rounded-md focus:ring-2 focus:ring-blue-600 outline-none">

          <label class="block text-sm text-gray-700">What challenges are you looking to solve?</label>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-gray-600">
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-blue-600"> Cloud Security</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-blue-600"> Incident Response</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-blue-600"> Managed Detection</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-blue-600"> Awareness Training</label>
          </div>

          <textarea rows="3" placeholder="How can we help?"
                    class="w-full p-3 border border-gray-200 rounded-md focus:ring-2 focus:ring-blue-600 outline-none"></textarea>

          <div class="flex items-center gap-3">
            <input id="consent" type="checkbox" class="accent-blue-600">
            <label for="consent" class="text-sm text-gray-600">
              Yes, I would like to receive marketing emails about solutions that may be of interest to me.
            </label>
          </div>

          <button type="submit"
                  class="w-full py-3 bg-gradient-to-tr from-orange-500 to-orange-400 text-white rounded-md font-semibold">
            Submit
          </button>

          <p class="text-xs text-gray-400 pt-2">
            By submitting this form, you agree to our Terms of Use and Privacy Policy. This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.
          </p>
        </form>
      </div>
    </div>
  </div>

  <!-- Blue Info Area (with Manipur overlay background) -->
  <section class="relative z-10 manipur-overlay text-white mt-20 flex items-center">
    <div class="max-w-7xl mx-auto px-6 py-20 relative z-10">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

        <!-- Column 1: Locations -->
        <div>
          <h4 class="text-sm uppercase tracking-widest text-blue-200 mb-3">High Court Complex, Mantripukhri</h4>
          <p class="text-sm leading-relaxed">
            High Court Complex <br>
            Mantripukhri, Chingmeirong, <br>
            Imphal, Heingang, Manipur 795001
          </p>
        </div>

        <!-- Column 2: Contact -->
        <div>
          <h4 class="text-sm uppercase tracking-widest text-blue-200 mb-3">Contact / Office Hours</h4>
          <p class="flex items-center gap-3 text-sm">
            <i class="fa-solid fa-phone text-blue-300"></i> +91 9615892598 / 0385-2911701
          </p>
          <p class="flex items-center gap-3 mt-3 text-sm">
            <i class="fa-solid fa-envelope text-blue-300"></i> hclscman@gmail.com
          </p>

          <h4 class="text-sm uppercase tracking-widest text-blue-200 mt-6 mb-3">Hours</h4>
          <p class="text-sm">Monday - Friday: 10:00 AM - 04:30 PM</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Transition band before gray footer -->
  <div class="transition-band"></div>

  <!-- Your actual site footer (gray) -->
  @include('homepage.layouts.footer')

</body>
</html>
