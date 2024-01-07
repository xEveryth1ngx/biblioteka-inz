document.addEventListener("DOMContentLoaded", function () {
    // Funkcja do śledzenia kliknięć
    const trackClick = (event) => {
        // Pobieramy informacje o klikniętym elemencie

        const targetElement = event.target;
        const elementType = targetElement.tagName.toLowerCase();
        const elementId = targetElement.id || null;
        const elementClasses = Array.from(targetElement.classList);

        // Tworzymy obiekt z informacjami
        const clickInfo = {
            type: "click",
            elementType,
            elementId,
            elementClasses,
            timestamp: new Date().toISOString(),
        };

        console.log("chuj");
        // Wysyłamy dane do API
        sendToApi(clickInfo);

        e.preventDefault();
    };

    // Funkcja do wysyłania danych do API
    const sendToApi = (data) => {
        const apiUrl = "/api/track"; // Podaj rzeczywisty endpoint API

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
});
