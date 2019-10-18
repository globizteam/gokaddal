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



// Search form submit validation if both fields have no value.
$('#searchform').submit(function (ev) {
  var count = 0;
  $('#searchform input').each(function(){
    if ($(this).val() == '')
    {
      count = count + 1;
    }
  })

  if (count == 2)
  {
    $(this).find('.input-group').css('border','1px solid red');
    ev.preventDefault();
  }
})

// Validation for search form if data enter hide red border
$('#searchform input').on('keyup',function () {
    $('#searchform').find('.input-group').css('border','none');
})

 // Categories on Home page
jQuery('.catg_item').matchHeight();

 // Blog on Home page
jQuery('.blog_item').matchHeight();

// listing_text
jQuery('.listing_text').matchHeight();



// jQuery('.owl-carousel').owlCarousel({
//         loop:true,
// 	    nav:true,
// 		margin:10,
// 		responsiveClass:true,
// 		responsive:{
// 			0:{
// 				items:1,
// 			},
// 			400:{
// 				items:1,
// 			},
// 			550:{
// 				items:2,
// 			},
//             900:{
//                 items:3,
//             },
//             1200:{
//                 items:4,
//             }
// 		}
// })



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


$('#newsletter').submit(function(e) {
  // alert('escsad');
    e.preventDefault(); // don't submit multiple times
    // alert($(this).find('.error').css('display','block'));
    
if ($(this).find('input').val() == '') 
  return;

    if( $('.newsltr').find('label').is(':visible')  )
    {
      console.log('i am in');
     $label = $('.newsltr').find('label').clone();
     $('.newsltr').find('label').remove();
     $('.newsltr').append($label); 
      // return;
    }else{

      this.submit(); // use the native submit method of the form element
      $('#subscription_suc_modal').modal('show'); //Open the model
      return;
// e.preventDefault();
    }
});

/*preventing form submissin for Join our community index page*/
// $('#newsletter').on('click', function(e){
//   if($(this).find('.error') == "undefined" )
//   {

//   }else{
//     e.preventDefault();

//   } 

// });


// //  Listing Page 
jQuery('.listing_match_item').matchHeight();


jQuery('.contact_match_height').matchHeight();



jQuery('.my_acc_match_height').matchHeight();


jQuery(window).on('load',function(){
	jQuery('#hot_solution_modal').modal('show');
});

/* custom js @Hardeep 16-09-2019 */
// $('.form-validate').validate();
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

// for signup on change if type is Provider company name should enter otherwise not
$('.user_type').on('change', function (argument) {
	var usertype = $(this).find("option:selected").text();
	if (usertype == 'Seeker') {
		// var comp_name = $('#UserSignupForm').find('.company_name').prop('disabled', true);
		var comp_name = $('#UserSignupForm').find('.company_name').hide();
		// alert(comp_name);
		// console.log($(this).parent().find()) ;
	}else{
		var comp_name = $('#UserSignupForm').find('.company_name').show();
		// alert('Provider');
	}
})



$(function() {
   var links = $('a.link').click(function() {
       links.parent().removeClass('active-sidebar');
       $(this).parent().addClass('active-sidebar');
   });
});


// // Add address validation as link in admin panel (add addresses) CMS link
// add-address
// $("#button").click(function() {
//     if ($("#alta").valid()) {
//         $("#alta").submit();
//     }
// })

// Highlight link if clicked
// $('li').on('click', function () {
//   $(this).addClass('active-sidebar');
// })


// $('#newsletter .news').on('click', function () {
//   var labelclone = $('.p_lr_6 > label').html().clone();
//   console.log($(labelclone));
//   // body...
// })

// var error_elem = $('#name-error').clone();
// alert(error_elem);
// $('#name-error').remove();
// $(error_elem).parent().append(error_elem); 

/*move element out from div*/
// $('.newsltr input').on('focusout keyup', function() {
//   // console.log($('.newsltr').find('#name-error').length);
//     // if($('.newsltr').find('#name-error').length > 0)
//     // {
//       // console.log($(this).find('#name-error'));
//       // return;
//       var error_elem = $('#name-error').clone();
//       $(this).find('#name-error').remove();
//       $(this).append(error_elem); 
//       console.log('consoling error element :');
//       console.log(error_elem);
//       // alert($(this).parent().find('#name-error').html());
//     });
// });

    $('ul.list > li > a > img').each(function() {
      $(this).closest('li').prepend(this);
    });

/*For search on site*/
$(document).on('click','.search_btn1',function(ev)
{
  ev.preventDefault();
  var location = $.trim($('#location').val());
  var looking_for = $.trim($('#looking_for').val());

// console.log(window.location.href.match(/^.*\//)[0]);return;

var rooturl = window.location.href.match(/^.*\//)[0];

  // var Newurl = rooturl+"searchprovider";  
  var rootpath = window.location.origin + "/"+window.location.pathname.split('/')[1]+"/"+'home/searchall' ;

  // alert(rootpath);return;
  // alert("/"+window.location.pathname.split('/')[1]);

    $.ajax({
       type: "GET",
       url: rootpath,
       data: ({location : location, lookingfor : looking_for, path:rootpath}),
       dataType: "html",
       success: function(msg)
       {
         // window.location.href = rootpath;
        // console.log('msg');
            //Receiving the result of search here
       }
    });

});

jQuery('.panel-collapse').on('show.bs.collapse', function () {
  jQuery(this).parent('.panel').find('.fa-angle-up').show();
  jQuery(this).parent('.panel').find('.fa-angle-down').hide();
})
jQuery('.panel-collapse').on('hide.bs.collapse', function () {
  jQuery(this).parent('.panel').find('.fa-angle-up').hide();
  jQuery(this).parent('.panel').find('.fa-angle-down').show();
})


/*custom validations for validate.js*/
$(document).ready(function() {
 // $("#UserSignupForm, #RateNReviewProviderDetailsForm, #UserLoginForm,  #forgot_password, #changePasswordForm").validate({
  $('form').each(function () {
    $(this).validate({
   rules: {
     name : {
       required: true,
       minlength: 3
     },
     email: {
       required: true,
       email: true
       // remote: 'admin_checkemailexist'
     },
     contact:{
       	required: true,
     	minlength:7,
     	maxlength:14,
       	number: true
     },
     company_name:{
       	required: true,
     	minlength:3,
     },
     address:{
       	required: true,
     	minlength:3,
     },
     country: {
       required: true,
       minlength: 3
     },
     state: {
       required: true,
       minlength: 3
     },
     password: {
       required: true,
       minlength: 6
     },
     current_password: {
       required: true,
       minlength: 6
     },
     new_password: {
       required: true,
       minlength: 6
     },
     confirm_password: {
       required: true,
       minlength: 6
     },
     rating: {
       required: true
     },
     description: {
       required: true,
       minlength:3
     },

     weight: {
       required: {
         depends: function(elem) {
           return $("#age").val() > 50
         }
       },
       number: true,
       min: 0
     }
   },
   messages : {
     name: {
       minlength: "Name should be at least 3 characters"
     },
     email: {
       email: "The email should be in the format: abc@domain.tld",
       // remote: "Already used"
     },
     contact:{
       minlength: "Contact should be at least 8 number long",
       maxlength: "Contact should not be more than 14 number long",
       required: "Please enter contact"
     },
     contact:{
       minlength: "Contact should be at least 8 number long",
       maxlength: "Contact should not be more than 14 number long",
       required: "Please enter contact",
       number: "Contact should be number only"
     },
     address:{
       minlength: "Address should be at least 3 characters long"
     },
     country:{
       minlength: "Country name should be atleast 3 characters long"
     },
     state:{
       minlength: "State name should be atleast 3 characters long"
     },
     password:{
       minlength: "Password should be atleast 6 characters long"
     },
     current_password:{
       minlength: "Password should be atleast 6 characters long"
     },
     description:{
       minlength: "Message should be atleast 3 characters long"
     }

   }
 });
});
});
