<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- owl -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<!-- swipe start -->
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js'></script>
<script type="text/javascript">
    jQuery(".carousel").swipe({
        swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
            if (direction == 'left') jQuery(this).carousel('next');
            if (direction == 'right') jQuery(this).carousel('prev');
        },
        allowPageScroll: "vertical" 
    });
</script>
<!-- swipe end -->
<script type="text/javascript">
var myCarousel = document.querySelector('#carouselExampleFade')
var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 6000,
  pause: 'hover',
  keyboard: true,
})
</script>
<!-- owl -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
	"use strict";
	$('#client-carousel').owlCarousel( {
			loop: true,
			center: true,
			items: 5,
			margin: 30,
			autoplay: true,
			autoplayTimeout: 2000,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 3
				},
				1170: {
					items: 3
				}
			}
		});
	});
</script>