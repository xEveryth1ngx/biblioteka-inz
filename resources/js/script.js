document.addEventListener("DOMContentLoaded", function () {
    const siteEntrance = () => {
        sendToApi({}, "/api/entrance");

        console.log('request sent');
    }

    // Funkcja do śledzenia kliknięć
    const trackClick = (event) => {
        // Pobieramy informacje o klikniętym elemencie

        const targetElement = event.target;
        const elementType = targetElement.tagName.toLowerCase();
        const elementId = targetElement.id || null;
        const elementClasses = Array.from(targetElement.classList);
        const page = window.location.href;
        const x = event.clientX;
        const y = event.clientY;
        const maxX = window.innerWidth;
        const maxY = window.innerHeight;

        // Tworzymy obiekt z informacjami
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

        // Wysyłamy dane do API
        sendToApi(clickInfo, "/api/click");

        e.preventDefault();
    };

    // Funkcja do wysyłania danych do API
    const sendToApi = (data, apiUrl) => {
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

    // Dodajemy nasłuchiwanie kliknięć na całej stronie
    document.body.addEventListener("click", trackClick);
    siteEntrance();
});
