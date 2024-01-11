import ApexCharts from 'apexcharts';

function getRandomColor() {
    let letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

document.addEventListener("DOMContentLoaded", async function () {
    // Site entrances
    let entranceSelect = document.querySelector('#chart_entrances_select');
    let data = await fetch('/api/entrance/' + entranceSelect.value, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    }).then(response => response.json())
        .catch(error => console.log(error));

    let options = {
        chart: {
            type: 'line',
            background: '#374151'
        },
        theme: {
            mode: 'dark',
        },
        series: [{
            name: 'wejścia',
            data: Object.entries(data.entrancesPerDay).map(([key, value]) => value),
        }],
        xaxis: {
            categories: Object.entries(data.entrancesPerDay).map(([key, value]) => key),
        }
    };

    const chart = new ApexCharts(document.querySelector("#chart_entrances"), options);

    chart.render();

    entranceSelect.onchange =  async (e) => {
        console.log('change event')
        data = await fetch('/api/entrance/' + entranceSelect.value, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        }).then(response => response.json());

        await chart.updateOptions({
            series: [{
                name: 'wejścia',
                data: Object.entries(data.entrancesPerDay).map(([key, value]) => value),
            }],
            xaxis: {
                categories: Object.entries(data.entrancesPerDay).map(([key, value]) => key),
            }
        })
    };

    // Clicks on site
    let clicksSelect = document.querySelector('#chart_clicks_select');

    data = await fetch('/api/click/' + clicksSelect.value, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        }
    }).then(response => response.json());

    console.log(data)

    options = {
        chart: {
            type: 'line',
            background: '#374151'
        },
        theme: {
            mode: 'dark',
        },
        series: [{
            name: 'kliknięcia',
            data: Object.entries(data.clicksPerDay).map(([key, value]) => value),
        }],
        xaxis: {
            categories: Object.entries(data.clicksPerDay).map(([key, value]) => key),
        }
    };

    const clickChart = new ApexCharts(document.querySelector("#chart_clicks"), options);

    clickChart.render();

    clicksSelect.onchange =  async (e) => {
        console.log('change event')
        data = await fetch('/api/click/' + clicksSelect.value, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        }).then(response => response.json());

        await clickChart.updateOptions({
            series: [{
                name: 'kliknięcia',
                data: Object.entries(data.clicksPerDay).map(([key, value]) => value),
            }],
            xaxis: {
                categories: Object.entries(data.clicksPerDay).map(([key, value]) => key),
            }
        })
    };


// Most clicked elements
    let mostClickedSelect = document.querySelector('#chart_most_clicked_select');

    data = await fetch('/api/most-clicked/' + mostClickedSelect.value, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        }
    }).then(response => response.json());

    console.log(data)

    data = data.mostClicked.map(item => {
        return {
            x: `${item.element_type} ${item.element_id ? '#' + item.element_id : ''} ${item.element_classes}`,
            y: item.total
        }
    })

    options = {
        chart: {
            type: 'bar',
            background: '#374151'
        },
        theme: {
            mode: 'dark',
        },
        series: [{
            name: 'kliknięcia',
            data: data
        }]
    };

    const mostClickedChart = new ApexCharts(document.querySelector("#chart_most_clicked"), options);

    mostClickedChart.render();

    mostClickedSelect.onchange =  async (e) => {
        console.log('change event')
        data = await fetch('/api/most-clicked/' + mostClickedSelect.value, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        }).then(response => response.json());

        await mostClickedChart.updateOptions({
            series: [{
                name: 'kliknięcia',
                data: data.mostClicked.map(item => {
                    return {
                        x: `${item.element_type} ${item.element_id ? '#' + item.element_id : ''} ${item.element_classes}`,
                        y: item.total
                    }
                })
            }],
        })
    };


    // Clicked heat map
    let clickMapSelect = document.querySelector('#chart_click_map_select');

    data = await fetch('/api/click-map/' + clickMapSelect.value, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        }
    }).then(response => response.json());

    console.log(data.clickMap)

    let maxValue = 0;
    for (let row of data.clickMap) {
        for (let key in row) {
            if (row[key] > maxValue) {
                maxValue = row[key];
            }
        }
    }

    const numSegments = 5;
    const intervalSize = Math.ceil(maxValue / numSegments);
    console.log(intervalSize)

    const colorScale = Array.from({ length: numSegments }, (_, index) => ({
        from: index * intervalSize,
        to: (index + 1) * intervalSize,
        color: getRandomColor() // Use a function to generate random colors or specify your own color logic
    }));

    const dataClickMap = Object.entries(data.clickMap).reverse().map(([key, value]) => {
        return {
            name: key,
            data: Object.entries(value).map(([key, value]) => {
                return {
                    x: key,
                    y: value,
                }
            })
        }
    });

    console.log(colorScale)

    options = {
        chart: {
            background: '#374151',
            type: 'heatmap',
        },
        plotOptions: {
            heatmap: {
                colorScale: {
                    ranges: colorScale
                }
            }
        },
        theme: {
            mode: 'dark',
        },
        series: dataClickMap,
    };

    const clickMapChart = new ApexCharts(document.querySelector("#chart_click_map"), options);

    clickMapChart.render();
});
