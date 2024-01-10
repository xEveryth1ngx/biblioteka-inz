<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Strona testowa</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <header class="w-3/4 h-12 mx-auto my-3 bg-gray-700 rounded-2xl flex justify-center items-center">
        <h1 class="m-2 text-white text-center text-2xl">WYNIKI</h1>
    </header>

    <main class="w-3/4 p-4 bg-gray-700 mx-auto my-5 rounded-2xl flex items-center flex-col">
        <div class="w-3/4 mt-5">
            <div class="flex justify-between items-center mb-3">
                <label for="chart_entrances" class="text-white text-2xl">Wejścia na stronę</label>
                <div class="flex justify-center items-center w-1/2">
                    <label for="chart_entrances_select" class="text-white mr-2">Okres</label>
                    <select id="chart_entrances_select" class="w-1/2 appearance-none bg-gray-800 border border-gray-600 text-white py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-700 focus:border-gray-500">
                        <option value="1" selected>Dzisiaj</option>
                        <option value="2">Ostatni tydzień</option>
                        <option value="3">Ostatni miesiąc</option>
                        <option value="4">Wszystkie rekordy</option>
                    </select>
                </div>
            </div>

            <div id="chart_entrances" class="rounded"></div>
        </div>

        <div class="w-3/4 mt-5">
            <div class="flex justify-between items-center mb-3">
                <label for="chart_clicks" class="text-white text-2xl">Ilość kliknięć na stronie</label>
                <div class="flex justify-center items-center w-1/2">
                    <label for="chart_clicks_select" class="text-white mr-2">Okres</label>
                    <select id="chart_clicks_select" class="w-1/2 appearance-none bg-gray-800 border border-gray-600 text-white py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-700 focus:border-gray-500">
                        <option value="1" selected>Dzisiaj</option>
                        <option value="2">Ostatni tydzień</option>
                        <option value="3">Ostatni miesiąc</option>
                        <option value="4">Wszystkie rekordy</option>
                    </select>
                </div>
            </div>

            <div id="chart_clicks" class="rounded"></div>
        </div>

        <div class="w-3/4 mt-5">
            <div class="flex justify-between items-center mb-3">
                <label for="chart_most_clicked" class="text-white text-2xl">Najczęściej klikane elementy</label>
                <div class="flex justify-center items-center w-1/2">
                    <label for="chart_most_clicked_select" class="text-white mr-2">Okres</label>
                    <select id="chart_most_clicked_select" class="w-1/2 appearance-none bg-gray-800 border border-gray-600 text-white py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-700 focus:border-gray-500">
                        <option value="1" selected>Dzisiaj</option>
                        <option value="2">Ostatni tydzień</option>
                        <option value="3">Ostatni miesiąc</option>
                        <option value="4">Wszystkie rekordy</option>
                    </select>
                </div>
            </div>

            <div id="chart_most_clicked" class="rounded"></div>
        </div>

        <div class="w-3/4 mt-5">
            <div class="flex justify-between items-center mb-3">
                <label for="chart_click_map" class="text-white text-2xl">Mapa cieplna kliknięć</label>
                <div class="flex justify-center items-center w-1/2">
                    <label for="chart_click_map_select" class="text-white mr-2">Okres</label>
                    <select id="chart_click_map_select" class="w-1/2 appearance-none bg-gray-800 border border-gray-600 text-white py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-700 focus:border-gray-500">
                        <option value="1" selected>Dzisiaj</option>
                        <option value="2">Ostatni tydzień</option>
                        <option value="3">Ostatni miesiąc</option>
                        <option value="4">Wszystkie rekordy</option>
                    </select>
                </div>
            </div>

            <div id="chart_click_map" class="rounded"></div>
        </div>
    </main>

    @vite('resources/js/chart.js')
</body>
