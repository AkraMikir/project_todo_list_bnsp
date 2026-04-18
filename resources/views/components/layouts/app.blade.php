<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>{{ $title ?? 'UpTodo' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-uptodo-bg text-white antialiased min-h-screen">
    <!-- Responsive Web App Container -->
    <div class="w-full min-h-screen flex flex-col relative overflow-hidden">
        <!-- Main Content Slot -->
        <main class="flex-grow w-full md:px-12 lg:px-24 xl:px-48 {{ auth()->check() ? 'pb-32' : '' }} overflow-y-auto">
            {{ $slot }}
        </main>
        
        <!-- Bottom Navigation Bar Component -->
        @if(auth()->check())
            <x-bottom-bar />
        @endif
    </div>

    @if(auth()->check())
        @include('partials.add-task')
    @endif
    @stack('scripts')
</body>
</html>
