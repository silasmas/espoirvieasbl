@if($hasViteManifest())
    {{-- Utiliser Vite si le manifest existe --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    {{-- Fallback: Utiliser Tailwind CSS et Alpine.js via CDN pour le développement --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Configuration Tailwind pour correspondre à la config du projet
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Figtree', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                },
            },
            plugins: [],
        }
    </script>
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- Axios pour les requêtes AJAX --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        window.axios = axios;
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    </script>
    {{-- Styles personnalisés si nécessaire --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endif
