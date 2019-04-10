/**
 * Simple slider.
 *
 * There are several settings in the Customizer.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

( function () {

	'use strict';

	const slider = document.querySelector( '#slider.slider' );

	if ( ! slider ) {

		return;

	}

	const list    = slider.querySelector( '.slider-list' ),
	items_arr     = Array.prototype.slice.call( slider.querySelectorAll( '.slider-item' ) ),
	items_img_arr = Array.prototype.slice.call( slider.querySelectorAll( '.slider-item img' ) ),
	prev          = slider.querySelector( '.slider-arrow-prev' ),
	next          = slider.querySelector( '.slider-arrow-next' ),
	active        = 'slider-item-active',
	inactive      = 'slider-item-inactive',
	auto          = 'slider-auto-true',
	tab           = 'user-is-tabbing';

	let duration = 300,
	time         = 5000,
	index        = 0,
	item_active  = items_arr[ index ],
	timer;

	/**
	 * Sets the background image.
	 *
	 * @since 1.0.0
	 */
	function set_background_image() {

		/* This function works only once. */
		set_background_image = function(){};

		items_arr.forEach(
			function( item, i ) {

					item.style.backgroundImage = 'url(' + items_img_arr[ i ].currentSrc + ')';

			}
		);

	}

	/**
	 * Changes the slide.
	 *
	 * @param string direction Previous or next slide.
	 * @param bool autoplay Changes the slides automatically or not.
	 *
	 * @since 1.0.0
	 */
	function change_slide( direction, autoplay ) {

		set_background_image();

		prev.disabled = true;
		next.disabled = true;

		if ( slider.classList.contains( auto ) ) {

			clearInterval( timer );
			timer = setInterval(
				function () {

					if ( ! document.body.classList.contains( tab ) ) {

						change_slide( 'next', true );

					}

				},
				time
			);

		}

		if ( direction == 'next' ) {

			index = ( index == items_arr.length - 1 ) ? 0 : index + 1;

		} else {

			index = ( index == 0 ) ? items_arr.length - 1 : index - 1;

		}

		items_arr[ index ].classList.add( active );
		items_arr[ index ].setAttribute( 'aria-expanded', true );

		item_active.classList.replace( active, inactive );
		item_active.setAttribute( 'aria-expanded', false );

		setTimeout(
			function() {

					/* Replace the inactive class from the current element and find the active one and re-assign it to the variable. */
					item_active.classList.remove( inactive );
					item_active = slider.querySelector( '.' + active );

					prev.disabled = false;
					next.disabled = false;

				if ( ! autoplay && document.body.classList.contains( tab ) ) {

					if ( direction == 'next' ) {

						next.focus();

					} else {

						prev.focus();

					}

				}

			},
			duration
		);

	}

	/* Assign functions to the buttons. */
	prev.addEventListener( 'click', function() { change_slide( 'prev', false ); } );
	next.addEventListener( 'click', function() { change_slide( 'next', false ); } );

	if ( slider.classList.contains( auto ) ) {

		timer = setInterval(
			function () {

				if ( ! document.body.classList.contains( tab ) ) {
					change_slide( 'next', true ); }

			},
			time
		);

	}

} )();
