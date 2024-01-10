import ApexCharts from 'apexcharts';

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

    options = {
        chart: {
            background: '#374151',
            type: 'heatmap',
        },
        theme: {
            mode: 'dark',
        },
        series: [
            {
                name: "Series 1",
                data: [{
                    x: 'W1',
                    y: 22
                }, {
                    x: 'W2',
                    y: 29
                }, {
                    x: 'W3',
                    y: 13
                }, {
                    x: 'W4',
                    y: 32
                }]
            },
            {
                name: "Series 2",
                data: [{
                    x: 'W1',
                    y: 43
                }, {
                    x: 'W2',
                    y: 43
                }, {
                    x: 'W3',
                    y: 43
                }, {
                    x: 'W4',
                    y: 43
                }]
            }
        ]
    };

    const clickMapChart = new ApexCharts(document.querySelector("#chart_click_map"), options);

    clickMapChart.render();
});
