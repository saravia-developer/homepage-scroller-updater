// window.addEventListener('elementor/frontend/init', () => {

//   elementorFrontend.hooks.addAction(
//     'frontend/element_ready/shortcode.default',
//     (scope) => {

      // 👇 scope viene como elemento DOM, no jQuery
      const container = document.querySelector('.hsu-slider.swiper');

      if (!container) return;

      new Swiper(container, {
        loop: true,
        pagination: {
          el: container.querySelector('.swiper-pagination'),
          clickable: true
        },
        navigation: {
          nextEl: container.querySelector('.swiper-button-next'),
          prevEl: container.querySelector('.swiper-button-prev'),
        },
        scrollbar: {
          el: container.querySelector('.swiper-scrollbar'),
        },
      });

//     }
//   );

// });