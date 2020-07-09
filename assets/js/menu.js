let hamburger = document.getElementById('hamburger');
let menuScroll = document.querySelectorAll('.jsMenuScroll');

let menuOpen = false;

hamburger.addEventListener('click', () => {
    if (menuOpen) {
        hamburger.classList.remove('open');
        menuScroll.forEach((item) => {
            item.classList.remove('open');
        });
        menuOpen = false;
    } else {
        hamburger.classList.add('open');
        menuScroll.forEach((item) => {
            item.classList.add('open');
        });
        menuOpen = true;
    }
});



