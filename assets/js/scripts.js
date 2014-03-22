/**
 * Scripts.js
 * User scripts and plugin instantiations
 * scripts.js should be called in the site footer
 */

//smooth scroll mofo
jQuery.fn.scrollToViewPort=function(a){a=(typeof a=="undefined")?"slow":a;return this.each(function(){$("html,body").animate({scrollTop:$(this).offset().top},a)})};

//fullscreen div homie

function fullscreen(css_class){
	$(css_class).css("width", $(window).width());
	$(css_class).css("height", $(window).height());
}

//vertical center

function v_center(css_class){
	$(css_class).css("top", ($(window).height() - $(css_class).outerHeight())/2);
}


$(document).ready(function() {

	$('html').addClass('js').removeClass('no-js');

	$('.scroll-up').click(function() {
		$('.fullscreen--home').scrollToViewPort();
	});

	$('.scroll-down').click(function() {
		$('.about').scrollToViewPort();
	});

	fullscreen('.fullscreen');
	v_center('.home-centralised');
	v_center('.home-loading');

	var ip_form = $('.input_form');

	ip_form.submit(function() {
		$( ".home-centralised" )
			.animate(
				{ display: 'none' },
				{ queue: false, duration: 'slow' }
			).css(
				'display', 'none'
			);
		$( ".home-loading" )
			.animate(
				{ opacity: 1 },
				{ queue: false, duration: 'slow' }
			);
	});

	var home_form = $(".home-centralised");

	home_form
		.css('opacity', 0)
		.animate(
			{ opacity: 1 },
			{ queue: false, duration: 'slow' }
		);

	$(':submit').click(function(e) {
	    $(':text, textarea, :password').each(function() {
				if ($(this).val().length == 0) {
					$(this).addClass('validation-problem');
					$('.alert-slidedown').slideDown('fast');
					e.preventDefault();
				}else{
					$(this).removeClass('validation-problem');
				}
	    });
	});
	$(':text, textarea, :password').each().change(function() {
		if ($(this).val().length > 0) {
			$(this).removeClass('validation-problem');
			$('.alert-slidedown').slideUp('fast');
		}
	});
});

$( window ).resize(function() {
	fullscreen('.fullscreen');
	v_center('.home-centralised');
	v_center('.home-loading');
});

