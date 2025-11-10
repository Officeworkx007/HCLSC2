<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Register Admin | HCLSC</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome (for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        hclsc: '#0A2240',
                        gold: '#FFD700',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">

    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-8 px-4">
        <div class="max-w-md w-full bg-white shadow-2xl rounded-2xl p-8 border border-gray-100">
            <h2 class="text-3xl font-extrabold text-hclsc text-center mb-2">Register Admin</h2>
            <p class="text-center text-gray-500 text-sm mb-6">Create a new admin account</p>

            <form method="POST" action="{{ route('admin.register', ['key' => request('key')]) }}" class="space-y-5">
                @csrf

                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" placeholder="John Doe" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-hclsc focus:border-hclsc transition">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" placeholder="example@email.com" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-hclsc focus:border-hclsc transition">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" placeholder="••••••••" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-hclsc focus:border-hclsc transition">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-hclsc focus:border-hclsc transition">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full py-3 px-4 bg-hclsc text-white font-semibold rounded-lg shadow-lg hover:bg-[#102C60] hover:shadow-xl transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-hclsc transition duration-200 ease-in-out">
                        <i class="fa-solid fa-user-plus mr-2"></i> Register Admin
                    </button>
                </div>
            </form>

            <!-- Footer Note -->
            <p class="text-center text-xs text-gray-400 mt-6">
                © {{ date('Y') }} High Court Legal Services Committee
            </p>
        </div>
    </div>

</body>
</html>
