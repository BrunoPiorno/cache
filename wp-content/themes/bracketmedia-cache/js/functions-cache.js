jQuery.noConflict();

jQuery(document).ready(function ($) {
	AOS.init({
		duration: 1500,
		offset: -200,
		once: true
	});
	$.fn.extend({
		scrollTo: function($diff, $duration = 1000 ){
			$diff   =   $diff || 0;
			$('html, body').stop().animate({scrollTop: this.offset().top-$diff}, $duration);
		},
	});

	$(window).scroll(function(){
		var sticky = $('body'),
		scroll = $(window).scrollTop();

		if (scroll >= 10) sticky.addClass('scrolled');
		else sticky.removeClass('scrolled');
	});

	$('.responsive__btn').click(function(){
		$(this).toggleClass('open');
		$('.responsive__menu').animate({
			width: "toggle"
		});
	});

	$('.element_slider__carousel').slick({
		dots: false,
		infinite: true,
		speed: 300,
		vertical: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		mobileFirst: true,
		prevArrow: '<button type="button" class="slick-prev"><p>UP</p></button>',
		nextArrow: '<button type="button" class="slick-next"><p>DOWN</p></button>'
	});

	
	$('.gallery__slider').slick({
		dots: true,
		arrows: false,
		infinite: false,
		speed: 300,
		slidesToShow: 3,
		adaptiveHeight: true,
		responsive: [
		  {
			breakpoint: 1100,
			settings: {
			  slidesToShow: 3
			}
		  },
		  {
			breakpoint: 800,
			settings: {
			  slidesToShow: 2
			}
		  },
		  {
			breakpoint: 500,
			settings: {
			  slidesToShow: 1
			}
		  }
		]
	  });
	
	$('.banner_slider__carousel').slick({
		draggable: true,
		dots: false,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		adaptiveHeight: true,
		fade: true,
		cssEase: 'ease-in-out',
    	touchThreshold: 100
	  });

	$('.slider-block').slick({
		dots: true,
		arrows: false,
		infinite: false,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1
	  });
	  
	  $('.products-slider__carousel .products, .related.products .products .slider_brand--cont').slick({
		dots: true,
		arrows: false,
		infinite: false,
		speed: 300,
		slidesToShow: 4,
		responsive: [
		  {
			breakpoint: 1100,
			settings: {
			  slidesToShow: 3
			}
		  },
		  {
			breakpoint: 800,
			settings: {
			  slidesToShow: 2
			}
		  },
		  {
			breakpoint: 500,
			settings: {
			  slidesToShow: 1
			}
		  }
		  // You can unslick at a given breakpoint now by adding:
		  // settings: "unslick"
		  // instead of a settings object
		]
	  });
	  $('.woocommerce-product-gallery ol').slick({
		dots: false,
		infinite: false,
		speed: 300,
		slidesToShow: 5,
		vertical: true,
		responsive: [
		  {
			breakpoint: 900,
			settings: {
			  vertical: false,
			  slidesToShow: 5
			}
		  },
		  {
			breakpoint: 500,
			settings: {
			  vertical: false,
			  slidesToShow: 3
			}
		  }
		  // You can unslick at a given breakpoint now by adding:
		  // settings: "unslick"
		  // instead of a settings object
		]
	  });
	  
	  $('.slider_brand--cont').slick({
		dots: true,
		arrows: false,
		infinite: true,
		autoplay: true,
		autoplaySpeed: 4000,
		slidesToShow: 4,
		slidesToScroll: 1,
		responsive: [
		  {
			breakpoint: 1100,
			settings: {
			  slidesToShow: 3
			}
		  },
		  {
			breakpoint: 800,
			settings: {
			  slidesToShow: 2
			}
		  },
		  {
			breakpoint: 500,
			settings: {
			  slidesToShow: 1
			}
		  }
		  // You can unslick at a given breakpoint now by adding:
		  // settings: "unslick"
		  // instead of a settings object
		]
	  });

	  $('.js-open-popup').click(function(){
		let elem =  $(this);
		if( elem.hasClass('active') ){
			elem.removeClass('active');
			$('.element_slider__item__dot__product.open').removeClass('open').fadeOut();
			console.log('if');
		}else{
			$('.element_slider__item__dot__product.open').removeClass('open').fadeOut().prev('.js-open-popup').removeClass('active');
			elem.addClass('active').next('.element_slider__item__dot__product').addClass('open').fadeIn();
			console.log('else');
		}
	 });

	 $(document).mouseup(function(e){
		var container = $('.element_slider__item__dot__product.open');
		var containerBtn = $('.js-open-popup.active');
		if( !container.is(e.target) && (container.has(e.target).length === 0) && !containerBtn.is(e.target) && (containerBtn.has(e.target).length === 0) ) {
			container.removeClass('open').hide();
			containerBtn.removeClass('active');
			console.log('mouseup');
		}
	});

	$('.close_popup, .close_popup--responsive').click(function(){
		$('.element_slider__item__dot__product, .features__content' ).fadeOut();
		$('.js-open-pop-up, .js-open-popup').removeClass('active')
	});

	 $('.js-open-pop-up').click(function(){
		let elem =  $(this);
		if( elem.hasClass('active') ){
			elem.removeClass('active');
			$('.features__content.open').removeClass('open').fadeOut();
		}else{
			$('.features__content.open').removeClass('open').fadeOut().prev().find('.js-open-pop-up').removeClass('active');
			elem.addClass('active').parent().next('.features__content').addClass('open').fadeIn();
		}
	 });


	$('.play-button').click(function(){
		$(this).hide();
		$(this).parent().find('.image_placeholder').hide();
	  	$(this).parent().find('video').get(0).play();
		$(this).parent().find('.controls').show();
	});
	$('.pause').click(function(){
		$(this).parent().hide();
		$(this).parent().parent().find('video').get(0).pause();
		$(this).parent().parent().find('.play-button').show();
	  	$(this).parent().parent().find('.image_placeholder').show();
	});
	/* Youtube Video *
	$('.play-button2').click(function(){
		$(this).hide();
		//$(this).parent().find('.image_placeholder').hide();
	  	//$(this).parent().find('embed').get(0).play();
		$(this).parent().parent().find('embed').slideDown();
		//$(this).parent().find('.controls2').show();
	});
	$('.pause2').click(function(){
		$(this).parent().hide();
		//$(this).parent().parent().find('embed').get(0).pause();
		$(this).parent().parent().find('embed').slideUp();
		//$(this).parent().parent().find('.play-button').show();
	  	//$(this).parent().parent().find('.image_placeholder').show();
	});
	*/
	$('.header ul li.menu-item-has-children > a').on('click', function(event) {
		event.preventDefault();
		var $elem = $(this).parents('li');
		if($elem.hasClass('active')){
			$elem.removeClass('active').find('ul.sub-menu').slideUp('fast');
		} else {
			$elem.addClass('active');
			$elem.siblings().removeClass('active').find('ul.sub-menu').slideUp('fast');
			$elem.find('ul.sub-menu').slideDown();
		}
		return false;
	});

	$('.js-tab-title').click(function(){
		let tab = $(this).attr('data-tab');
		$(".js-tab-content[data-tab='"+tab+"']").fadeIn().siblings('.js-tab-content').fadeOut();
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
        $("li.review").find('.form-contribution_comment').css('display', 'none');      


        /* UPDATE REVIEW */
        /* IF USER && REVIEWED */
        let data__comment__id = $('.review').find('.edit-comment').attr('data-comment-id');
        if (typeof data__comment__id !== 'undefined' && data__comment__id !== false) {
            $('.form-review').find('#comment_ID').val(data__comment__id);
    	    $('.form-review').find('#review_rating_field').removeClass('change-rating');
        }
        /* -- */
	});

    /* ADMIN EDITS REVIEW */
    $('.edit-comment').click(function(){
    	$('.form-review').find('#comment_ID').val($(this).attr('data-comment-id'));
    	$('.form-review').find('#review_rating_field').removeClass('change-rating');
        $('.form-review').find('.button').addClass('update-review');
        $('.form-review').find('.button').html('UPDATE REVIEW');
    });

	$('.faqs__text__cont--faqs').click(function(){
		let isOpen = $(this).hasClass('open');
		$('.faqs__text__cont--faqs.open').removeClass('open').next('.panel').slideUp();
		if( !isOpen )
		{
			$(this).addClass('open').next('.panel').slideDown(400);
		}
	});

	$('.section__subnav--select button').click(function() {
      	$(this).toggleClass('is--active')
      	$(this).parent().next('.section__subnav').slideToggle().toggleClass('is--visible');
  	});
});
window.addEventListener('load', function() {
	AOS.refresh();
});
  