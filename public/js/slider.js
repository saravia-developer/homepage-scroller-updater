const slider = document.querySelector('.hsu-slider');
const track = document.querySelector('.hsu-slides');
const slides = document.querySelectorAll('.hsu-slide');

const quantitySlides = slides.length;

let currentIndex = 0; // 👈 AQUÍ NACE
let startX = 0;
let isDragging = false;


slider.addEventListener('mousedown', (e) => {
    isDragging = true;
    startX = e.clientX;
});

slider.addEventListener('mouseup', (e) => {
    if (!isDragging) return;

    let diff = e.clientX - startX;

    if (diff > 50) {
        // 👉 arrastró a la derecha → slide anterior
        currentIndex = (currentIndex - 1 + quantitySlides) % quantitySlides;
    } else if (diff < -50) {
        // 👉 arrastró a la izquierda → siguiente slide
        currentIndex = (currentIndex + 1) % quantitySlides;
    }

    goToSlide(currentIndex);
    isDragging = false;
});

function goToSlide(index) {
    currentIndex = index;

    track.style.transform = `translateX(-${index * 100/quantitySlides}%)`;
}


slider.addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
});

slider.addEventListener('touchend', (e) => {
    let endX = e.changedTouches[0].clientX;
    let diff = endX - startX;

    if (diff > 50) {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    } else if (diff < -50) {
        currentIndex = (currentIndex + 1) % slides.length;
    }

    goToSlide(currentIndex);
});

slider.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    // if (e.target.closest('a, button')) return;

    let diff = e.clientX - startX;
    track.style.transform = `translateX(calc(-${currentIndex * 100}% + ${diff}px))`;
});