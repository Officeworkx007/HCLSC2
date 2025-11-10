<footer class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-600 text-slate-300 mt-16">
    {{-- Main Container: Reduced max-width slightly for a more constrained look --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Reduced vertical padding (py-10 -> py-8) --}}
        <div class="py-8 md:py-10 flex flex-col lg:flex-row flex-wrap items-start gap-8 lg:gap-12">

            {{-- Simplified layout: center-aligned on mobile, left-aligned on large screens --}}
            <div class="flex flex-col items-center lg:items-start text-center lg:text-left min-w-[220px] lg:w-1/4">
                <img src="/images/hc logo footer.png" alt="High Court of Manipur logo" class="h-16 w-auto mb-2">
                <p class="text-slate-200 font-bold text-lg leading-snug">
                    High Court Legal Services Committee
                </p>
                <p class="text-xs text-slate-400 mt-1">
                    Committed to ensuring access to justice.
                </p>
            </div>

            {{-- Adjusted grid for better spacing and compactness on larger screens --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-12 w-full lg:w-3/4">

                <div>
                    <h4 class="text-slate-50 font-semibold mb-3 text-base uppercase tracking-wider">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Legal Aid</a></li>
                        <li><a href="#" class="hover:text-white transition">National Lok Adalat</a></li>
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-slate-50 font-semibold mb-3 text-base uppercase tracking-wider">Popular Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="https://hcmimphal.nic.in/" class="hover:text-white transition">High Court of Manipur</a></li>
                        <li><a href="#" class="hover:text-white transition">NALSA</a></li>
                        <li><a href="#" class="hover:text-white transition">MASLSA</a></li>
                    </ul>
                </div>

                <div>
                    {{-- Added 'Connect With Us' as a more professional heading for social links --}}
                    <h4 class="text-slate-50 font-semibold mb-3 text-base uppercase tracking-wider">Connect With Us</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">YouTube</a></li>
                        <li><a href="#" class="hover:text-white transition">Instagram</a></li>
                        <li><a href="#" class="hover:text-white transition">Facebook</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-700/60"></div>

        {{-- Reduced vertical padding (py-6 -> py-4) --}}
        <div class="py-4 flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
            <p class="text-xs sm:text-sm text-slate-400">
                © Developed by High Court Legal Services Committee, 2025. All Rights Reserved.
            </p>

            <div class="flex items-center justify-center gap-4">
                <a href="#" class="p-2 rounded-full hover:bg-slate-700/60 transition" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="h-5 w-5 text-slate-200">
                        <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm0 2h10c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3zm5 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6zm4.5-.75a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 0 0 0 2.5z" />
                    </svg>
                </a>

                <a href="#" class="p-2 rounded-full hover:bg-slate-700/60 transition" aria-label="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="h-5 w-5 text-slate-200">
                        <path d="M19.6 3H4.4A3.4 3.4 0 0 0 1 6.4v11.2A3.4 3.4 0 0 0 4.4 21h15.2a3.4 3.4 0 0 0 3.4-3.4V6.4A3.4 3.4 0 0 0 19.6 3zM10 15.5v-7l6 3.5-6 3.5z" />
                    </svg>
                </a>

                <a href="#" class="p-2 rounded-full hover:bg-slate-700/60 transition" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="h-5 w-5 text-slate-200">
                        <path d="M22 12.06C22 6.5 17.52 2 11.94 2 6.37 2 1.88 6.5 1.88 12.06c0 4.93 3.6 9.02 8.32 9.88v-6.99H7.9v-2.9h2.3v-2.2c0-2.28 1.35-3.54 3.43-3.54.99 0 2.03.18 2.03.18v2.23h-1.14c-1.12 0-1.47.7-1.47 1.42v1.92h2.5l-.4 2.9h-2.1v6.99c4.72-.86 8.32-4.95 8.32-9.88z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>
