window.addEventListener('DOMContentLoaded', function() {
	const container = document.querySelector('.hsu-slider.swiper');
	const swiper = new Swiper(container, {
	  direction: 'horizontal',
	  loop: true,
		
	  autoplay: {
      	delay: 5000,
      	disableOnInteraction: false,
	  },

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
})