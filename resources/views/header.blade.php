<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Clean IoT Monitoring</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#00535b",
                        error: "#ba1a1a",
                        outline: "#6f797a",
                        background: "#f7fafa",
                        surface: "#ffffff",
                        secondary: "#236863",
                        tertiary: "#713d10",
                        "surface-container": "#ebeeef",
                        "surface-container-low": "#f1f4f4",
                        "surface-bright": "#f7fafa",
                        "outline-variant": "#bec8ca",
                        "on-surface": "#181c1d",
                        "on-surface-variant": "#3e494a",
                        "secondary-container": "#a9ece5",
                        "on-secondary-container": "#286d67",
                        "tertiary-fixed": "#ffdcc5",
                        "tertiary-container": "#8e5426",
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24;
        }
    </style>

</head>

<body class="bg-background text-on-surface min-h-screen">

    <!-- HEADER -->
    <header
        class="bg-surface border-b border-outline-variant fixed top-0 left-0 right-0 z-50 shadow-sm">

        <div class="flex items-center justify-between px-4 md:px-6 py-4">

            <!-- KIRI -->
            <div class="flex items-center gap-3">

                <h1 class="text-xl md:text-2xl font-bold text-primary whitespace-nowrap">
                    Clean IoT
                </h1>

            </div>

            <!-- TENGAH -->
            <nav class="flex items-center gap-4 md:gap-8">

                <a href="/"
                    class="text-sm md:text-base text-on-surface-variant hover:text-primary transition font-medium">
                    Dashboard
                </a>

                <a href="/info"
                    class="text-sm md:text-base text-on-surface-variant hover:text-primary transition font-medium">
                    Info
                </a>

            </nav>

            <!-- KANAN -->
            <div class="flex items-center">

                <a href="/login"
                    class="text-primary hover:text-secondary transition">

                    <span class="material-symbols-outlined text-[34px]">
                        account_circle
                    </span>

                </a>

            </div>

        </div>


    </header>

    <!-- CONTENT -->
    <main>

        @yield('content')

    </main>

</body>

</html>