/**
 * The theme removes the outline by default (because it does not look good), but when the user uses the keyboard
 * navigators, we simply add a class 'user-is-tabbing' to the body that adds the outline.
 * https://hackernoon.com/removing-that-ugly-focus-ring-and-keeping-it-too-6c8727fefcd2
 *
 * @package priscila
 * @since 1.0.0
 */

( function () {

	'use strict';

	/**
	 * Adds the class 'user-is-tabbing' to the body after pressing the TAB key.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent
	 *
	 * @param KeyboardEvent e Describes a user interaction with the keyboard.
	 *
	 * @since 1.0.0
	 */
	function user_is_tabbing( e ) {

		if ( e.keyCode === 9 ) { /* The 'I am a keyboard user' key. */

			document.body.classList.add( 'user-is-tabbing' );
			window.removeEventListener( 'keydown', user_is_tabbing );

		}

	}

	window.addEventListener( 'keydown', user_is_tabbing );

} )();
