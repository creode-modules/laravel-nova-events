<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Events</title>

       {{-- Laravel Vite - CSS File --}}
       {{-- {{ module_vite('build-events', 'Resources/assets/sass/app.scss') }} --}}
        <script src="https://cdn.tailwindcss.com"></script>

    </head>
    <body>
        <main class="container mx-auto">
            @yield('content')
        </main>


        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-events', 'Resources/assets/js/app.js') }} --}}
    </body>
</html>
