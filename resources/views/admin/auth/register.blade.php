@vite('resources/css/app.css')

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8 px-4">
    <div class="max-w-md w-full bg-white shadow-lg rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Register Admin</h2>

        <form method="POST" action="{{ route('admin.register', ['key' => request('key')]) }}" class="space-y-5">
            @csrf

            <!-- Full Name -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Full Name</label>
                <input type="text" name="name" placeholder="John Doe" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                <input type="email" name="email" placeholder="example@email.com" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                <input type="password" name="password" placeholder="••••••••" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="••••••••" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 text-white font-medium rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-500 transition">
                    Register Admin
                </button>
            </div>
        </form>
    </div>
</div>
