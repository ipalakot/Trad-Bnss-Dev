/**
 * The search engine functionality in the site header.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

( function () {

	'use strict';

	const header = document.querySelector( '#masthead' ),
	show_btn     = header.querySelector( '.search-show-btn' ),
	container    = header.querySelector( '.search-container' );

	if ( ! container ) {

		return;

	}

	const hide_btn = container.querySelector( '.search-hide-btn' ),
	field          = container.querySelector( '.search-field' ),
	search_btn     = container.querySelector( '.search-button' ),
	class_visible  = 'search-container-visible';

	let shift_key_status = false;

	/*--------------------------------------------------------------
	# TOGGLE SEARCH
	--------------------------------------------------------------*/

	function toggle_search() {

		/**
		 * Toggles the visibility of the search engine.
		 *
		 * @since 1.0.0
		 */

		if ( container.classList.contains( class_visible ) ) {

			container.classList.remove( class_visible );
			container.setAttribute( 'aria-expanded', false );

			show_btn.focus();

			window.removeEventListener( 'keydown', change_shift_key_status_to_true );

		} else {

			container.classList.add( class_visible );
			container.setAttribute( 'aria-expanded', true );

			window.addEventListener( 'keydown', change_shift_key_status_to_true );

			setTimeout(
				function() {

						field.focus();

				},
				300
			);

		}

	}

	if ( show_btn && hide_btn ) {

		show_btn.addEventListener( 'click', toggle_search );
		hide_btn.addEventListener( 'click', toggle_search );

	}

	/*--------------------------------------------------------------
	# USER EXPERIENCE
	--------------------------------------------------------------*/

	document.addEventListener(
		'keydown',
		/**
		 * Hides the search by clicking the ESC key on the keyboard.
		 *
		 * @link https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent
		 *
		 * @param KeyboardEvent e Describes a user interaction with the keyboard.
		 *
		 * @since 1.0.0
		 */
		function( e ) {

			if ( e.keyCode == 27 && container.classList.contains( class_visible ) ) {

				toggle_search();

			}

		}
	);

	/*--------------------------------------------------------------
	# ACCESSIBILITY ( TAB KEY SUPPORT )
	--------------------------------------------------------------*/

	/**
	 * Changes the value of the variable shift_key_status to true when the user presses the SHIFT key.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent
	 *
	 * @param KeyboardEvent e Describes a user interaction with the keyboard.
	 *
	 * @since 1.0.0
	 */
	function change_shift_key_status_to_true( e ) {

		shift_key_status = e.shiftKey ? true : false;

	}

	if ( search_btn ) {

		search_btn.addEventListener(
			'focusout',
			/**
			 * If the value of variable shift_key_status is false, focus the hide_btn.
			 *
			 * @since 1.0.0
			 */
			function() {

				if ( shift_key_status ) {

					shift_key_status = false;

				} else {

					hide_btn.focus();

				}

			}
		);

	}

	if ( field ) {

		field.addEventListener(
			'focusout',
			/**
			 * It changes the value of shift_key_status to false.
			 *
			 * @since 1.0.0
			 */
			function() {

				shift_key_status = false;

			}
		);

	}

	if ( hide_btn ) {

		hide_btn.addEventListener(
			'focusout',
			/**
			 * If the value of variable shift_key_status is true, focus the search_btn.
			 *
			 * @since 1.0.0
			 */
			function( e ) {

				if ( shift_key_status ) {

					search_btn.focus();
					shift_key_status = false;

				}

			}
		);

	}

} )();
