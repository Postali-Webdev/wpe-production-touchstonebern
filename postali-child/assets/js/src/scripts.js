/**
 * Theme scripting
 *
 * @package Postali Child
 * @author Postali LLC
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
	"use strict";

	//Hamburger animation
    $('.toggle-nav').click(function() {
        $(this).toggleClass('active');
        $('#menu-main-menu').toggleClass('opened');
        $('#menu-main-menu').toggleClass('active'); 
        $('.sub-menu').removeClass('opened');
        $('.sub-menu').addClass('closed');
        return false;
	});
	    //Close navigation on anchor tap
    $('.active').click(function() {	
        $('#menu-main-menu').addClass('closed');
        $('#menu-main-menu').toggleClass('opened');
        $('#menu-main-menu .sub-menu').removeClass('opened');
        $('#menu-main-menu .sub-menu').addClass('closed');
    });	
	 
	//Close navigation on anchor tap
	$('.toggle-nav.active').click(function() {	
		$('#menu-main-menu').slideUp(400);
	});	

	//Mobile menu accordion toggle for sub pages
    $('#menu-main-menu > li.menu-item-has-children').prepend('<div class="accordion-toggle"><span class="icon-chevron-right"></span></div>');
	$('#menu-main-menu > li.menu-item-has-children > .sub-menu').prepend('<div class="child-close"><span class="icon-chevron-left"></span> back</div>');
	
	$('.child-close').click(function() {
        $(this).parent().toggleClass('opened');
        $(this).parent().toggleClass('closed');
    });

    $('.tertiary-close').click(function() {
        $(this).parent().toggleClass('opened');
        $(this).parent().toggleClass('closed');
    });

    // script to make accordions function
	$(".accordions").on("click", ".accordions_title", function() {
        // will (slide) toggle the related panel.
        $(this).toggleClass("active").next().slideToggle();
    });

	//keeps menu expanded so user can tab through sub-menu, then closes menu after user tabs away from last child
	$(document).ready(function () {
		$('.menu-item-has-children').on('focusin', function() {
			var subMenu = $(this).find('.sub-menu');
			subMenu.css('display', 'block');

			$(this).find('.sub-menu > li:last-child').on('focusout', function() {
				subMenu.css('display', 'none');
			})
		})
	});

    $('#menu-main-menu > li.menu-item-has-children').on('click', function(event) {
        // event.preventDefault();
        if( !$(event.target).is('a') && !$(event.target).hasClass('child-close')) {
            $(this).find('.sub-menu').addClass('opened');
            $(this).find('.sub-menu').removeClass('closed');
        }
    });

	// Toggle search function in nav
	$( document ).ready( function() {
		var width = $(document).outerWidth()
		if (width > 992) {
			var open = false;
			$('#search-button').attr('type', 'button');
			
			$('#search-button').on('click', function(e) {
					if ( !open ) {
						$('#search-input-container').removeClass('hdn');
						$('#search-button span').removeClass('icon-magnifying-glass').addClass('icon-close-x');
						$('#menu-main-menu li.menu-item').addClass('disable');
						open = true;
						return;
					}
					if ( open ) {
						$('#search-input-container').addClass('hdn');
						$('#search-button span').removeClass('icon-close-x').addClass('icon-magnifying-glass');
						$('#menu-main-menu li.menu-item').removeClass('disable');
						open = false;
						return;
					}
			}); 
			$('html').on('click', function(e) {
				var target = e.target;
				if( $(target).closest('.navbar-form-search').length ) {
					return;
				} else {
					if ( open ) {
						$('#search-input-container').addClass('hdn');
						$('#search-button span').removeClass('icon-close-x').addClass('icon-magnifying-glass');
						$('#menu-main-menu li.menu-item').removeClass('disable');
						open = false;
						return;
					}
				}
			});
		}
	});

	$('.mobile-filter-accordion').on('click', function () {
		$('.filters').slideToggle(400).css('display', 'flex');
		$(this).toggleClass('active');
	});
		
	function removeSplash(i) {
		Cookies.set('visited', true, { expires: 1 });
		$(`.splash-screen .block-${i}`).fadeOut(600);
		if (i == 13) {
			$(`.splash-screen`).fadeOut(900);
		}
	}

	function offsetTimer(i) {
		if (i == 13) {
			return 3500;
		} else {
			return 825 + (i * 205);
		}
	}

	var visited = Cookies.get('visited');
	if (visited) {
		$('.splash-screen').css('display', 'none');
	} else {
		$('.splash-screen').css('opacity', '1');
		var blockList = $('.splash-screen .block');
		for (var i = 1; i <= blockList.length + 1; i++) {
			(function(i) {
				setTimeout(function() {
					removeSplash(i);
				}, offsetTimer(i));
			})(i);
		}		
	}
    

});