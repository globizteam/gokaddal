// ===== Scroll to Top ==== 
jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        jQuery('#return_to_top').fadeIn(200);    // Fade in the arrow
    } else {
        jQuery('#return_to_top').fadeOut(200);   // Else fade out the arrow
    }
});
jQuery('#return_to_top').click(function() {      // When arrow is clicked
    jQuery('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});



//  Categories on Home page
jQuery('.catg_item').matchHeight();

//  Blog on Home page
jQuery('.blog_item').matchHeight();

// listing_text
jQuery('.listing_text').matchHeight();



jQuery('.owl-carousel').owlCarousel({
        loop:true,
	    nav:true,
		margin:10,
		responsiveClass:true,
		responsive:{
			0:{
				items:1,
			},
			400:{
				items:1,
			},
			550:{
				items:2,
			},
            900:{
                items:3,
            },
            1200:{
                items:4,
            }
		}
})



var screen_width = jQuery( window ).width();
if(screen_width < 992){
    jQuery(".top_main_menu .dropdown-toggle").attr("data-toggle","dropdown");
}else{
	$(".top_main_menu .dropdown").mouseenter(function() {
	    $(this).find('.dropdown-menu').css("display", "block");
	}).mouseleave(function() {
	     $(this).find('.dropdown-menu').css("display", "none");
	});
}




//  Listing Page 
jQuery('.listing_match_item').matchHeight();


jQuery('.contact_match_height').matchHeight();



jQuery('.my_acc_match_height').matchHeight();


jQuery(window).on('load',function(){
	jQuery('#hot_solution_modal').modal('show');
});

/* custom js @Hardeep 16-09-2019 */
$('.form-validate').validate();
// fading out flash messages after 5 seconds
$('#flashMessage').delay(5000).fadeOut(400);

$('.rating-given').on('click', function(ev) {
	ev.preventDefault();
	$('.show-rate-msg').toggle().setTimeout(function() {}, 10);
})

$('.save_favourites').on('click', function(ev) {
	ev.preventDefault();
	$('.added_favourite').toggle().setTimeout(function() {}, 10);
})
