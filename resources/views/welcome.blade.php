<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite('resources/css/app.css');

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <section class="bg-white dark:bg-gray-900">
            <div class="container flex flex-col items-center px-4 py-12 mx-auto text-center">
                <h2 class="max-w-2xl mx-auto text-2xl font-semibold tracking-tight text-gray-800 xl:text-3xl dark:text-white">
                    Bienvenidos a la API de  <span class="text-blue-500">AHO Inmobiliaria</span>
                </h2>

                <p class="max-w-4xl mt-6 text-center text-gray-500 dark:text-gray-300">
                    Aqui encontraras la documentacion de la API de AHO Inmobiliaria
                </p>


            </div>
        </section>
    </body>
</html>



