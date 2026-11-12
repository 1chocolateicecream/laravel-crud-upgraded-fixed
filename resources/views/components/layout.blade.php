<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Products' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <header>
            <x-navigation />
        </header>

        <aside aria-live="polite">
            @if (session('message'))
                <div class="status-message">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('error'))
                <div class="error-message" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-message" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </aside>

        <main>
            {{ $slot }}
        </main>

        <footer>
            &copy; Ventspils Tehnikums 2025
        </footer>
    </div>
</body>
</html>
