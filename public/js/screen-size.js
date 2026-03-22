function ScreenSize() {
  const screenWidth = window.innerWidth;
  const slides = document.querySelectorAll(".hsu-slider .hsu-slide");
  const track = document.querySelector(".hsu-slider .hsu-slides");

  track.style.width = `${screenWidth * slides.length}px`;

  slides.forEach((slide) => {
    slide.style.width = `${screenWidth}px`;
  });
}

window.addEventListener("resize", ScreenSize);
window.addEventListener("load", ScreenSize);