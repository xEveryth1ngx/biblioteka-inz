const pageName = 'http://127.0.0.1:8000';

document.addEventListener("DOMContentLoaded", function () {
    const siteEntrance = () => {
        sendToApi({}, pageName + "/api/entrance");
    }

    const trackClick = (event) => {
        const targetElement = event.target;
        const elementType = targetElement.tagName.toLowerCase();
        const elementId = targetElement.id || null;
        const elementClasses = Array.from(targetElement.classList);
        const page = window.location.href;
        const x = event.clientX;
        const y = event.clientY;
        const maxX = window.innerWidth;
        const maxY = window.innerHeight;

        const clickInfo = {
            type: "click",
            elementType,
            elementId,
            elementClasses,
            timestamp: new Date().toISOString(),
            page,
            x,
            y,
            width: maxX,
            height: maxY,
        };

        sendToApi(clickInfo, pageName + "/api/click");

        e.preventDefault();
    };

    const sendToApi = (data, apiUrl) => {
        fetch(apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "*/*",
                'Access-Control-Allow-Origin': '*',
            },
            body: JSON.stringify(data),
        })
            .then((response) => response.json())
            .catch((error) => {
                console.log("Błąd podczas wysyłania danych do API:", error);
            });
    };

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

    document.body.addEventListener("click", trackClick);
    siteEntrance();

    setInterval(() => {
        sendToApi({
            maxScroll: maxPercentageGlobal.toFixed(),
            page: page,
        }, pageName + '/api/scroll');
    }, 5000);
});
