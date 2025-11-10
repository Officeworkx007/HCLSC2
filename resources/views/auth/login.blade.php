<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Admin Login | HCLSC</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome (optional) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Tailwind Custom Theme -->
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

    <div class="flex min-h-screen items-center justify-center bg-gray-50">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 space-y-6 border border-gray-100">
            <h2 class="text-3xl font-extrabold text-center text-hclsc mb-2">Admin Login</h2>
            <p class="text-center text-gray-500 text-sm">Authorized personnel only</p>

            <form method="POST" action="{{ route('admin.login', ['key' => request('key')]) }}" class="space-y-5 mt-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-hclsc focus:ring-hclsc sm:text-sm p-3 bg-gray-50 transition" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-hclsc focus:ring-hclsc sm:text-sm p-3 bg-gray-50 transition" />
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-hclsc hover:bg-[#102C60] text-white font-semibold py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200 ease-in-out">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i> Login as Admin
                </button>
            </form>

            <!-- Footer Note -->
            <p class="text-center text-xs text-gray-400 mt-4">
                © {{ date('Y') }} High Court Legal Services Committee
            </p>
        </div>
    </div>

</body>
</html>
