/**
 * Slick Custom
 *
 * @package Postali Child
 * @author Postali LLC
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
	"use strict";

	$('#slider').slick({
		dots: false,
		infinite: true,
		fade: true,
		autoplay: true,
  		autoplaySpeed: 5000,
  		speed: 1300,
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: false,
    	nextArrow: false,
    	swipeToSlide: true,
		cssEase: 'ease-in-out'
	});

	$('.banner-slider .inner-slider').slick({
		dots: false,
		infinite: true,
		fade: true,
		autoplay: true,
		autoplaySpeed: 3000,
		speed: 1300,
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: false,
		nextArrow: false,
		swipeToSlide: true,
		cssEase: 'ease-in-out',
		pauseOnHover: false,
		pauseOnDotsHover: false
	});
	$('.banner-slider .slider-nav').slick({
		dots: true,
		infinite: true,
		fade: true,
		autoplay: true,
		autoplaySpeed: 3000,
		speed: 1300,
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: false,
		nextArrow: false,
		swipeToSlide: true,
		cssEase: 'ease-in-out',
		pauseOnHover: false,
		pauseOnDotsHover: false
	});




	
});