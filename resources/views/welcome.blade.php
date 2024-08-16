<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hospital System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen flex items-center justify-center">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-8 dark:text-white">Hospital System</h1>
                <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                    <nav class="space-x-4">
                        <a
                            href="{{ route('login') }}"
                            class="inline-block rounded-md bg-[#FF2D20] px-6 py-3 text-white transition hover:bg-[#e0261c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF2D20]"
                        >
                            Log in
                        </a>
                        <a
                            href="{{ route('register') }}"
                            class="inline-block rounded-md bg-[#FF2D20] px-6 py-3 text-white transition hover:bg-[#e0261c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF2D20]"
                        >
                            Register
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </body>
</html>
