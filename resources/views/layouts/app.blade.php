<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Price Configurator</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen relative">

    <main class="py-8">
        @yield('content')
    </main>

    @livewireScripts
</body>

</html>
