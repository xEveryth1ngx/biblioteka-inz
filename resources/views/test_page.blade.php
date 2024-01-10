<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Strona testowa</title>
    @vite('resources/css/app.css')
</head>

<body class="font-sans bg-gray-200">

    <header class="bg-gray-800 text-white text-center py-4">
        <h1 class="text-2xl">Przykładowa Strona Biznesowa</h1>
    </header>

    <nav class="bg-gray-700 text-white py-2 flex gap-2">
        <a href="#section1" class="hover:text-gray-300 bg-gray-800 rounded p-1.5 ml-2">Sekcja 1</a>
        <a href="#section2" class="hover:text-gray-300 bg-gray-800 rounded p-1.5">Sekcja 2</a>
        <a href="#section3" class="hover:text-gray-300 bg-gray-800 rounded p-1.5">Sekcja 3</a>
        <a href="#section4" class="hover:text-gray-300 bg-gray-800 rounded p-1.5">Galeria</a>
    </nav>

    <div class="wrapper p-5">
        <main class="mt-3 bg-gray-700 rounded p-5">
            <section id="section1" class="content mb-3">
                <h2 class="text-2xl text-white">Sekcja 1</h2>
                <p class="text-amber-50">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt mi sed urna aliquam,
                    sit amet finibus sem dapibus. Quisque auctor libero justo, id mattis est viverra nec.
                    Maecenas in urna sit amet velit blandit lobortis sed sed orci. Etiam dignissim lectus dui, ut consequat arcu rutrum vel.
                    Mauris aliquet lorem eget metus convallis rhoncus et sit amet turpis. Integer volutpat lacus enim, id porta ligula consectetur vel.
                    Curabitur lobortis venenatis orci, congue elementum elit pulvinar id.
                    In quis risus malesuada, eleifend massa et, placerat augue. Phasellus id pretium arcu.
                </p>
            </section>

            <section id="section2" class="content mb-3">
                <h2 class="text-2xl text-white">Sekcja 2</h2>
                <p class="text-amber-50">
                    Duis consectetur ac arcu sit amet auctor.
                    Praesent eget velit mattis, dictum nisl a, luctus felis. Nullam quis faucibus elit, eget imperdiet metus.
                    Suspendisse efficitur enim magna, sed rhoncus odio finibus a. Phasellus non lorem id velit tempor dictum vel non sapien.
                    Duis porttitor ante eget metus hendrerit ullamcorper. Curabitur efficitur leo ac tempor pretium. Morbi elementum malesuada felis id vehicula.
                    Quisque ut lorem ultricies, blandit risus ut, fringilla odio.
                    Sed sit amet ante facilisis purus mattis porta sit amet non ligula.
                    Cras eu porta odio. Sed sit amet tellus a elit iaculis volutpat.
                    Donec nisi diam, consectetur sed ex nec, tincidunt gravida nisl.
                </p>
            </section>

            <section id="section3" class="content mb-3">
                <h2 class="text-2xl text-white">Sekcja 3</h2>
                <p class="text-amber-50">
                    Duis pellentesque in tortor non fringilla. Maecenas ac mattis diam.
                    Fusce fermentum mi diam, non placerat odio porta vel. Quisque id finibus ex, vulputate aliquam ipsum.
                    Aenean imperdiet non augue non aliquam. Morbi elementum malesuada quam, molestie ultricies quam hendrerit at.
                    Maecenas sit amet luctus magna. Curabitur egestas quam vitae tincidunt dapibus. Duis sollicitudin placerat felis, in efficitur dui faucibus ac.
                    Fusce a bibendum purus.
                    Suspendisse varius porta est.
                    Integer ullamcorper volutpat ultricies. Cras venenatis ac ipsum vitae suscipit.
                </p>
            </section>

            <section id="section4" class="content mt-5">
                <h2 class="text-2xl text-amber-50">Galeria</h2>
                <div class="gallery flex flex-wrap justify-around mt-4">
                    <!-- Dodaj zdjęcia do galerii -->
                    <img src="https://via.placeholder.com/300" alt="Image 1" class="w-full max-w-xs mb-4 rounded">
                    <img src="https://via.placeholder.com/300" alt="Image 2" class="w-full max-w-xs mb-4 rounded">
                    <img src="https://via.placeholder.com/300" alt="Image 3" class="w-full max-w-xs mb-4 rounded">
                </div>
            </section>
        </main>

        <form id="contactForm" class="content mt-8 p-5 bg-gray-700 rounded">
            <h2 class="text-2xl text-amber-50">Formularz Kontaktowy</h2>
            <label for="name" class="block mb-2 text-amber-50">Imię:</label>
            <input type="text" id="name" name="name" required class="w-full p-2 mb-4 border rounded">

            <label for="email" class="block mb-2 text-amber-50">Email:</label>
            <input type="email" id="email" name="email" required class="w-full p-2 mb-4 border rounded">

            <label for="message" class="block mb-2 text-amber-50">Wiadomość:</label>
            <textarea id="message" name="message" rows="4" required class="w-full p-2 mb-4 border rounded"></textarea>

            <button type="submit" class="bg-gray-800 text-white py-2 px-4 rounded cursor-pointer transition duration-500 hover:bg-gray-700">Wyślij</button>
        </form>
    </div>
    <footer class="mt-8 bg-gray-800 text-white text-center py-4">
        &copy; 2023 Przykładowa Strona Biznesowa
    </footer>

{{--    <script src="../js/script.js"></script>--}}
    @vite('resources/js/app.js')
</body>
</html>
