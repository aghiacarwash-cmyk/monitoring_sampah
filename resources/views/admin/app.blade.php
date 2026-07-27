<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary-fixed": "#acefe7",
                        "on-tertiary": "#ffffff",
                        "surface-dim": "#d7dadb",
                        "outline-variant": "#bec8ca",
                        "on-secondary-fixed-variant": "#00504b",
                        "on-secondary-fixed": "#00201e",
                        "inverse-on-surface": "#eef1f2",
                        "background": "#f7fafa",
                        "secondary-container": "#a9ece5",
                        "tertiary-container": "#8e5426",
                        "on-secondary-container": "#286d67",
                        "error-container": "#ffdad6",
                        "primary-fixed": "#9ff0fb",
                        "primary": "#00535b",
                        "surface-container-highest": "#e0e3e3",
                        "on-primary": "#ffffff",
                        "error": "#ba1a1a",
                        "surface": "#f7fafa",
                        "tertiary": "#713d10",
                        "surface-container-low": "#f1f4f4",
                        "primary-container": "#006d77",
                        "on-surface": "#181c1d",
                        "surface-container-lowest": "#ffffff",
                        "surface-container": "#ebeeef",
                        "surface-container-high": "#e6e9e9",
                        "outline": "#6f797a",
                        "on-background": "#181c1d",
                        "surface-variant": "#e0e3e3",
                        "on-surface-variant": "#3e494a",
                    },

                    spacing: {
                        "stack-sm": "8px",
                        "stack-md": "16px",
                        "gutter": "24px",
                        "card-padding": "20px",
                        "margin-page": "32px",
                        "stack-lg": "24px"
                    }
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24;
        }

        body {
            background-color: #f7fafa;
            font-family: Inter, sans-serif;
        }
    </style>

</head>
<!-- Firebase -->


<body class="text-on-surface">

    @include('admin.sidebar')

    <main class="ml-64 min-h-screen">

        @include('admin.header')

        <div class="p-margin-page">
            @yield('content')
        </div>

    </main>
    <script type="module">

        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.2/firebase-app.js";
        import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.13.2/firebase-messaging.js";

        const firebaseConfig = {
            apiKey: "AIzaSyCYl3EDyuMJmnVtW8vO4GYL_0l0-Gcp6JQ",
            authDomain: "clean-iot-monitoring.firebaseapp.com",
            projectId: "clean-iot-monitoring",
            storageBucket: "clean-iot-monitoring.firebasestorage.app",
            messagingSenderId: "733183787328",
            appId: "1:733183787328:web:3b18917e105f22b5007aa5"
        };

        const app = initializeApp(firebaseConfig);
        const messaging = getMessaging(app);

        Notification.requestPermission().then((permission) => {

            if (permission === "granted") {

                navigator.serviceWorker.register('/firebase-messaging-sw.js')
                    .then((registration) => {

                        getToken(messaging, {
                            vapidKey: "BNaAmUOo69gtnMTgoYge2WJxBHinqbEih6yy5NVuZcYUrJCY_bJhpi-SEqV3fj-kd6Ce7YTi8a3eK6yZ2-t66aE",
                            serviceWorkerRegistration: registration
                        })
                            .then((currentToken) => {

                                if (currentToken) {

                                    fetch('/save-fcm-token', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                        },
                                        body: JSON.stringify({
                                            token: currentToken
                                        })
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            console.log("Token berhasil disimpan", data);
                                        })
                                        .catch(error => {
                                            console.error(error);
                                        });

                                    

                                } else {

                                    console.log("Token tidak didapat.");

                                }

                            })
                            .catch((err) => {

                                console.error("FCM ERROR:", err);

                            });

                    });

            }

        });
    </script>

</body>

</html>