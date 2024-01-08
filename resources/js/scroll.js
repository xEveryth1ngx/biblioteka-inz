document.addEventListener("DOMContentLoaded", function () {
    let maxPercentageGlobal = 0;
    let currentInViewElement = null;

    function getScrollPercent() {
        let h = document.documentElement,
            b = document.body,
            st = 'scrollTop',
            sh = 'scrollHeight';
        return (h[st]||b[st]) / ((h[sh]||b[sh]) - h.clientHeight) * 100;
    }

    window.addEventListener('scroll', function () {
        // updateInViewElement();
        // const totalScroll = document.documentElement.scrollHeight - window.innerHeight;
        const percentageScrolled = getScrollPercent();
        if (percentageScrolled >= maxPercentageGlobal) {
            maxPercentageGlobal = percentageScrolled;
        }

        console.clear(); // Clear console for better readability
        console.log('Current in-view element:', currentInViewElement);
        console.log('Percentage of page scrolled:', percentageScrolled.toFixed(2) + '%');
        console.log('Max percentage of page scrolled:', maxPercentageGlobal.toFixed(2) + '%')
    });
});
