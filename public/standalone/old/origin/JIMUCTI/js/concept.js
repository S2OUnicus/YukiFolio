jQuery(function ($) {
	function changeImage() {
		var $graphic = $('#graphic ul');
		var $frontmost = $graphic.children('.now');
		var $next;
		if($frontmost.next()[0] != undefined){
			$next = $frontmost.next();
		} else {
			$next = $graphic.children().first();
		}
		$frontmost.removeClass('now');
		$next.addClass('now');
		
	}
	setInterval(changeImage, 4000);
});

const targets = document.querySelectorAll('.slide-in, .slide-in-right');

const observer = new IntersectionObserver(
  (entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active');
        obs.unobserve(entry.target);
      }
    });
  },
  {
    root: null,
    threshold: 0,
    rootMargin: '-40% 0px -40% 0px',
  }
);

targets.forEach(target => observer.observe(target));

