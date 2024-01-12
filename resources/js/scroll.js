document.addEventListener("DOMContentLoaded", function () {
    let maxPercentageGlobal = 0;
    let currentInViewElement = null;
    const page = window.location.href;

    function getScrollPercent() {
        let h = document.documentElement,
            b = document.body,
            st = 'scrollTop',
            sh = 'scrollHeight';
        return (h[st]||b[st]) / ((h[sh]||b[sh]) - h.clientHeight) * 100;
    }

    window.addEventListener('scroll', function () {
        const percentageScrolled = getScrollPercent();
        if (percentageScrolled >= maxPercentageGlobal) {
            maxPercentageGlobal = percentageScrolled;
        }
    });

    const sendToApi = (data) => {
        const apiUrl = "/api/scroll"; // Podaj rzeczywisty endpoint API

        // Używamy metody Fetch do wysłania danych
        fetch(apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
            .then((response) => response.json())
            .then((responseData) => {
                console.log("Dane zostały wysłane do API:", responseData);
            })
            .catch((error) => {
                console.error("Błąd podczas wysyłania danych do API:", error);
            });
    };

    setInterval(() => {
        sendToApi({
            maxScroll: maxPercentageGlobal.toFixed(),
            page: page,
        });
    }, 5000);
});
