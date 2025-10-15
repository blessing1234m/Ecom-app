<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300">
    <title>@yield('title', 'Admin - Ecom-App')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.jpg') }}">

    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])

    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body class="bg-gray-100">
              <!-- Guest (admin) simple centered layout for auth pages -->
        <main class="min-h-screen flex items-center justify-center px-4 py-8">
            @yield('content')
        </main>

    <!-- Vite JS -->
    @vite(['resources/js/app.js'])

    <script>
        // Mobile Menu Toggle
        document.querySelector('.mobile-menu-button')?.addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });
    </script>

    @stack('scripts')

    <script>
        // Fonction de rafraîchissement automatique du contenu
        function setupAutoRefresh() {
            const mainContent = document.querySelector('main');
            const refreshInterval = 60000; // Rafraîchissement toutes les 60 secondes

            setInterval(async () => {
                try {
                    const response = await fetch(window.location.href);
                    const text = await response.text();
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(text, 'text/html');
                    const newContent = doc.querySelector('main');

                    if (newContent && mainContent) {
                        mainContent.innerHTML = newContent.innerHTML;
                    }
                } catch (error) {
                    console.error('Erreur lors du rafraîchissement:', error);
                }
            }, refreshInterval);
        }

        // Initialiser le rafraîchissement automatique
        document.addEventListener('DOMContentLoaded', setupAutoRefresh);
    </script>
</body>

</html>
