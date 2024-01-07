<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Api</title>
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

    <div class="wrapper">
        <main class="mt-8">
            <section id="section1" class="content">
                <h2 class="text-2xl">Sekcja 1</h2>
                <p>Tutaj znajdziesz treść sekcji 1...</p>
            </section>

            <section id="section2" class="content">
                <h2 class="text-2xl">Sekcja 2</h2>
                <p>Tutaj znajdziesz treść sekcji 2...</p>
            </section>

            <section id="section3" class="content">
                <h2 class="text-2xl">Sekcja 3</h2>
                <p>Tutaj znajdziesz treść sekcji 3...</p>
            </section>

            <section id="section4" class="content">
                <h2 class="text-2xl">Galeria</h2>
                <div class="gallery flex flex-wrap justify-around mt-4">
                    <!-- Dodaj zdjęcia do galerii -->
                    <img src="https://via.placeholder.com/300" alt="Image 1" class="w-full max-w-xs mb-4 rounded">
                    <img src="https://via.placeholder.com/300" alt="Image 2" class="w-full max-w-xs mb-4 rounded">
                    <img src="https://via.placeholder.com/300" alt="Image 3" class="w-full max-w-xs mb-4 rounded">
                </div>
            </section>
        </main>

        <form id="contactForm" class="content mt-8">
            <h2 class="text-2xl">Formularz Kontaktowy</h2>
            <label for="name" class="block mb-2">Imię:</label>
            <input type="text" id="name" name="name" required class="w-full p-2 mb-4 border rounded">

            <label for="email" class="block mb-2">Email:</label>
            <input type="email" id="email" name="email" required class="w-full p-2 mb-4 border rounded">

            <label for="message" class="block mb-2">Wiadomość:</label>
            <textarea id="message" name="message" rows="4" required class="w-full p-2 mb-4 border rounded"></textarea>

            <button type="submit" onclick="trackActivity()" class="bg-gray-800 text-white py-2 px-4 rounded cursor-pointer transition duration-500 hover:bg-gray-700">Wyślij</button>
        </form>
    </div>
    <footer class="mt-8 bg-gray-800 text-white text-center py-4">
        &copy; 2023 Przykładowa Strona Biznesowa
    </footer>

{{--    <script src="../js/script.js"></script>--}}
    @vite('resources/js/app.js')
</body>
</html>
