(function($) {
    "use strict";
	
	/* COUNTDOWN */
	$("#countdown").countdown({
		date: "06 Mart 2015 00:00:00", // Put your date here
		format: "on"
	});
	
	/* TOOLTIPS */
	$('.tool-tip').tooltip();
	
	
	/* jQuery Vegas Slider */
	// For slideshow:
	$.vegas('slideshow', {
		delay: 7000,
		backgrounds: [
			{ src:'/application/public/images/image01.jpg', fade:1000 },
			{ src:'/application/public/images/image02.jpg', fade:1000 },
			{ src:'/application/public/images/image03.jpg', fade:1000 },
			{ src:'/application/public/images/image04.jpg', fade:1000 },
			{ src:'/application/public/images/image05.jpg', fade:1000 }
		]
	})('overlay', {
		src: '/application/public/img/06.png'
	});
	// For single image:
	/*$.vegas({
		src:'./images/image01.jpg'
	})('overlay', {
		src: './vegas/overlays/06.png'
	});*/
	
	/* OPEN BUTTONS */
	$('.newsletter-btn').click(function(e){
		e.preventDefault();
		$('.current').fadeOut(function(){
			$('.newsletter').fadeIn();
			$('.current').removeClass('current');
			$('.newsletter').addClass('current');
		});
	});
	$('.contact-btn').click(function(e){
		e.preventDefault();
		$('.current').fadeOut(function(){
			$('.contact').fadeIn();
			$('.current').removeClass('current');
			$('.contact').addClass('current');
		});
	});
	$('.about-btn').click(function(e){
		e.preventDefault();
		$('.current').fadeOut(function(){
			$('.about').fadeIn();
			$('.current').removeClass('current');
			$('.about').addClass('current');
		});
	});
	$('.social-btn').click(function(e){
		e.preventDefault();
		$('.current').fadeOut(function(){
			$('.social').fadeIn();
			$('.current').removeClass('current');
			$('.social').addClass('current');
		});
	});
	$('.close-btn').click(function(e){
		e.preventDefault();
		$('.current').fadeOut(function(){
			$('.main').fadeIn();
			$('.current').removeClass('current');
			$('.main').addClass('current');
		});
	});
    
    /* CONTACT FORM */
	$('#contact-form').ketchup().submit(function() {
		$('#contact-form-submit').button('loading');
        if (validateEmail($('#contact-email').val()) && $('#contact-email').val().length !== 0 && $('#contact-name').val().length !== 0 && $('#contact-message').val().length !== 0) {
            var action = $(this).attr('action');
            $.ajax({
                type: "POST",
                url : action,
                data: {
                    contactname: $('#contact-name').val(),
                    contactemail: $('#contact-email').val(),
                    contactmessage: $('#contact-message').val()
                },
                success: function() {
					$('#contact-form-submit').button('reset');
                    $('#contact-error').fadeOut();
                    $('#contact-success').fadeOut();
                    $('#contact-success').html('Success! Thanks for contacting us!').fadeIn();
                },
                error: function() {
					$('#contact-form-submit').button('reset');
                    $('#contact-error').fadeOut();
                    $('#contact-success').fadeOut();
                    $('#contact-error').html('Sorry, an error occurred.').fadeIn();
                }
            });
        } else if (!validateEmail($('#contact-email').val()) && $('#contact-email').val().length !== 0 && $('#contact-name').val().length !== 0 && $('#contact-message').val().length !== 0) {
			$('#contact-form-submit').button('reset');
			$('#contact-error').fadeOut();
			$('#contact-success').fadeOut();
			$('#contact-error').html('Please enter a valid email.').fadeIn();
		} else {
			$('#contact-form-submit').button('reset');
			$('#contact-error').fadeOut();
			$('#contact-success').fadeOut();
			$('#contact-error').html('Please fill out all the fields.').fadeIn();
		}
        return false;
    });
	
	/* NEWSLETTER FORM */
	$('#newsletter-form').ketchup().submit(function() {
		$('#newsletter-submit').button('loading');
		if (validateEmail($('#newsletter-email').val()) && $('#newsletter-email').val().length !== 0) {
			var action = $(this).attr('action');
			$.ajax({
				url: action,
				type: 'POST',
				data: {
					newsletter_email: $('#newsletter-email').val()
				},
				success: function(data) {
					$('#newsletter-submit').button('reset');
                    $('#newsletter-error').fadeOut();
                    $('#newsletter-success').fadeOut();
                    $('#newsletter-success').html(data).fadeIn();
                },
                error: function() {
					$('#newsletter-submit').button('reset');
                    $('#newsletter-error').fadeOut();
                    $('#newsletter-success').fadeOut();
                    $('#newsletter-error').html('Sorry, an error occurred.').fadeIn();
                }
			});
		} else {
			$('#newsletter-submit').button('reset');
			$('#newsletter-error').fadeOut();
			$('#newsletter-success').fadeOut();
			$('#newsletter-error').html('Please enter a valid email.').fadeIn();
		}
		return false;
	});
	
	/* VALIDATE EMAIL */
	function validateEmail($validate_email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if( !emailReg.test( $validate_email ) ) {
			return false;
		} else {
			return true;
		}
	}
    
    /* ANIMATIONS */
    $('.logo').bind('inview', function (event, visible) {
		if (visible === true) {
			$(this).addClass('animated fadeInDown');
		} else {
			$(this).removeClass('animated fadeInDown');
		}
	});
	$('.time').bind('inview', function (event, visible) {
		if (visible === true) {
			$(this).addClass('animated fadeInUp');
		} else {
			$(this).removeClass('animated fadeInUp');
		}
	});
	$('.newsletter-btn').bind('inview', function (event, visible) {
		if (visible === true) {
			$(this).addClass('animated fadeInDown');
		} else {
			$(this).removeClass('animated fadeInDown');
		}
	});
	$('.contact-btn').bind('inview', function (event, visible) {
		if (visible === true) {
			$(this).addClass('animated fadeInDown');
		} else {
			$(this).removeClass('animated fadeInDown');
		}
	});
	$('.about-btn').bind('inview', function (event, visible) {
		if (visible === true) {
			$(this).addClass('animated fadeInUp');
		} else {
			$(this).removeClass('animated fadeInUp');
		}
	});
    
})(jQuery);