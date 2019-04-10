/**
 * Handles toggling the navigation menu for small screens & enables TAB key navigation support for dropdown menus.
 *
 * @package priscila
 * @since 1.0.0
 */

( function () {

	'use strict';

	const header = document.querySelector( '#masthead' ),
	nav          = header.querySelector( '#primary-nav' ),
	list         = nav.querySelector( '.primary-nav-list' );

	if ( ! list ) {

		return;

	}

	const items_arr     = Array.prototype.slice.call( list.querySelectorAll( 'li' ) ),
	dds                 = list.querySelectorAll( '.primary-nav-dropdown' ),
	list_container      = nav.querySelector( '.primary-nav-list-container' ),
	show_nav_btn        = nav.querySelector( '.primary-nav-show-btn' ),
	hide_nav_btn        = nav.querySelector( '.primary-nav-hide-btn' ),
	dd_btns_arr         = Array.prototype.slice.call( nav.querySelectorAll( '.primary-nav-dropdown-btn' ) ),
	dd_active_class     = 'dropdown-active',
	btn_dd_active_class = 'clicked',
	ie                  = window.navigator.userAgent.indexOf( 'Trident/' ),
	edge                = window.navigator.userAgent.indexOf( 'Edge/' );

	/*--------------------------------------------------------------
	# TOGGLE NAVIGATION
	--------------------------------------------------------------*/

	/**
	 * Shows navigation.
	 *
	 * Adds active class to navigation, sets aria attributes, removes scroll from the body.
	 *
	 * @since 1.0.0
	 */
	function show_nav() {

		nav.classList.add( 'primary-nav-active' );

		nav.setAttribute( 'aria-expanded', true );
		list.setAttribute( 'aria-expanded', true );

		window.addEventListener( 'keydown', change_shift_key_status_to_true );

		const scroll_class = ( ie > 0 || edge > 0 ) /* If Internet Explorer or Edge */ ? 'remove-scroll-ie' : 'remove-scroll';
		document.body.setAttribute( 'scroll', 'no' );
		document.body.classList.add( scroll_class );
		document.documentElement.classList.add( scroll_class );

		set_which_nav_item_is_currently_last();

		setTimeout(
			function() {

				if ( document.body.classList.contains( 'user-is-tabbing' ) ) {
					hide_nav_btn.focus(); }

			},
			300
		);

	}

	if ( show_nav_btn ) {
		show_nav_btn.addEventListener( 'click', show_nav ); }

	/**
	 * Hides navigation.
	 *
	 * Removes active class to navigation, removes active dropdowns, sets aria attributes, adds scroll to the body.
	 *
	 * @since 1.0.0
	 */
	function hide_nav() {

		nav.classList.remove( 'primary-nav-active' );

		nav.setAttribute( 'aria-expanded', false );
		list.setAttribute( 'aria-expanded', false );

		window.removeEventListener( 'keydown', change_shift_key_status_to_true );

		const scroll_class = ( ie > 0 || edge > 0 ) /* If Internet Explorer or Edge */ ? 'remove-scroll-ie' : 'remove-scroll';
		document.body.removeAttribute( 'scroll' );
		document.body.classList.remove( scroll_class );
		document.documentElement.classList.remove( scroll_class );

		setTimeout(
			function() {

				if ( document.body.classList.contains( 'user-is-tabbing' ) ) {

					show_nav_btn.focus();

				}

				hide_dropdowns();

			},
			300
		);

	}

	if ( hide_nav_btn ) {

		hide_nav_btn.addEventListener( 'click', hide_nav );

	}

	/*--------------------------------------------------------------
	# DROPDOWN
	--------------------------------------------------------------*/

	/**
	 * Toggles dropdowns.
	 *
	 *	Updates which dropdown is now active after clicking the arrow button.
	 *
	 * @since 1.0.0
	 */
	function toggle_dropdown() {

		const dropdown = this.nextElementSibling;

		if ( dropdown.classList.contains( dd_active_class ) ) {

			dropdown.previousElementSibling.classList.remove( btn_dd_active_class );
			dropdown.classList.remove( dd_active_class );
			dropdown.setAttribute( 'aria-expanded', false );

		} else {

			const current_active = nav.querySelectorAll( '.primary-nav-item-depth-0 .' + dd_active_class );

			if ( this.parentNode.classList.contains( 'primary-nav-item-depth-0' ) && current_active ) {

				const current_active_length = current_active.length;

				for ( let i = 0; i < current_active_length; i++ ) {

					current_active[ i ].previousElementSibling.classList.remove( btn_dd_active_class );
					current_active[ i ].classList.remove( dd_active_class );
					current_active[ i ].setAttribute( 'aria-expanded', false );

				}
			}

			dropdown.previousElementSibling.classList.add( btn_dd_active_class );
			dropdown.classList.add( dd_active_class );
			dropdown.setAttribute( 'aria-expanded', true );

		}

		set_which_nav_item_is_currently_last();

	}

	dd_btns_arr.forEach(
		function( btn ) {

				btn.addEventListener( 'click', toggle_dropdown );

		}
	);

	/**
	 * Switches the active and inactive class when you hover over an element having children.
	 *
	 * The function checks if the element contains a dropdown. If so, it toggles the active/inactive class and the dropdown appears.
	 * The function only occurs on desktop devices and is deleted when the hamburger button appears.
	 *
	 * @since 1.0.0
	 */
	function toggle_dropdown_on_hover() {

		const btn = this.querySelector( 'button' ),
		ul        = this.querySelector( 'ul' );

		/* If there are no children, do nothing. */
		if ( ! btn || ! ul ) {

			return;

		} else if ( btn.classList.contains( btn_dd_active_class ) ) { /* If the active class already exists, it deletes it. */

			btn.classList.remove( btn_dd_active_class );
			ul.classList.remove( dd_active_class );
			ul.setAttribute( 'aria-expanded', false );

		} else { /* If not, it adds. */

			btn.classList.add( btn_dd_active_class );
			ul.classList.add( dd_active_class );
			ul.setAttribute( 'aria-expanded', true );

		}

	}

	/**
	 * Deactivates all dropdowns.
	 *
	 * @since 1.0.0
	 */
	function hide_dropdowns() {

		const dds_length = dds.length;

		for ( let i = 0; i < dds_length; i++ ) {

			dds[ i ].classList.remove( dd_active_class );
			dds[ i ].previousElementSibling.classList.remove( btn_dd_active_class );
			dds[ i ].setAttribute( 'aria-expanded', false );

		}

	}

	/*--------------------------------------------------------------
	# USER EXPERIENCE
	--------------------------------------------------------------*/

	document.addEventListener(
		'keydown',
		/**
		 * Hides the navigation by clicking the ESC key on the keyboard.
		 *
		 * @link https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent
		 *
		 * @param KeyboardEvent e Describes a user interaction with the keyboard.
		 *
		 * @since 1.0.0
		 */
		function( e ) {

			if ( e.keyCode == 27 && nav.classList.contains( 'primary-nav-active' ) ) {

				hide_nav();

			}

		}
	);

	/*--------------------------------------------------------------
	# ACCESSIBILITY ( TAB KEY SUPPORT )
	--------------------------------------------------------------*/

	const last_depth_0_item     = list.querySelectorAll( 'li.primary-nav-item-depth-0:last-child' )[ 0 ],
	last_depth_0_item_btn       = last_depth_0_item.querySelector( '.primary-nav-dropdown-btn' ),
	last_depth_0_item_links_arr = Array.prototype.slice.call( last_depth_0_item.querySelectorAll( 'a' ) ),
	last_depth_0_item_btns_arr  = Array.prototype.slice.call( last_depth_0_item.querySelectorAll( 'button' ) );

	let shift_key_status = false,
	last_item            = ( last_depth_0_item.contains( last_depth_0_item_btn ) ) ? last_depth_0_item_btn : last_depth_0_item;

	/**
	 * Sets the focus to hide_nav_btn when you click the TAB key.
	 *
	 * When the last element in the navigation is selected and the user presses the TAB key to go to the next element, it selects the hide_nav_btn as active.
	 *
	 * @since 1.0.0
	 */
	function last_nav_item_tab_to_hide_nav_btn() {

		const a = ( this.tagName == 'A' && ! this.nextElementSibling && ! this.parentNode.nextElementSibling && last_depth_0_item_links_arr.indexOf( this ) == last_depth_0_item_links_arr.length - 1 ),
		btn     = ( this.tagName == 'BUTTON' && ! this.nextElementSibling.classList.contains( dd_active_class ) && ! this.parentNode.nextElementSibling );

		if ( ( a || btn ) && shift_key_status == false ) {

			hide_nav_btn.focus();

		} else {

			shift_key_status = false;

		}

	}

	last_depth_0_item_links_arr.forEach(
		function( item ) {

			item.addEventListener( 'focusout', last_nav_item_tab_to_hide_nav_btn );

		}
	);

	last_depth_0_item_btns_arr.forEach(
		function( btn ) {

			btn.addEventListener( 'focusout', last_nav_item_tab_to_hide_nav_btn );

		}
	);

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

	/**
	 * Checks which visible (active) element in the navigation is currently the last.
	 *
	 * @param node element new_list Optional. List of navigation elements.
	 *
	 * @since 1.0.0
	 */
	function set_which_nav_item_is_currently_last( new_list ) {

		let children         = new_list ? new_list.childNodes : list.childNodes,
		li_arr               = [],
		li_last,
		li_last_children,
		li_last_children_length,
		li_last_children_arr = [],
		btn, ul, a;

		const children_length = children.length;

		for ( let i = 0; i < children_length; i++ ) {

			if ( children[ i ].nodeName == 'LI' ) {

				li_arr.push( children[ i ] );

			}

		}

		li_last                 = li_arr[ li_arr.length - 1 ];
		li_last_children        = li_last.childNodes;
		li_last_children_length = li_last_children.length;

		for ( let i = 0; i < li_last_children_length; i++ ) {

			let el = li_last_children[ i ];

			if ( el.nodeName == 'A' || el.nodeName == 'BUTTON' || el.nodeName == 'UL' ) {

				el.classList.add( 'child-' + el.nodeName );
				li_last_children_arr.push( el );

			}

		}

		a   = li_last.getElementsByClassName( 'child-A' )[ 0 ];
		btn = li_last.getElementsByClassName( 'child-BUTTON' )[ 0 ];
		ul  = li_last.getElementsByClassName( 'child-UL' )[ 0 ];

		if ( ul && ul.classList.contains( dd_active_class ) ) {

			set_which_nav_item_is_currently_last( ul );
			return;

		} else if ( btn ) {

			last_item = btn;

		} else {

			last_item = a;

		}

	}

	/**
	 * When hide_nav_btn is currently selected, the function allows you to go to the last active navigation element by clicking the TAB + SHIFT key.
	 *
	 * @since 1.0.0
	 */
	function hide_nav_btn_tab_to_last_nav_item() {

		if ( shift_key_status == true ) {

			last_item.focus();
			shift_key_status = false;

		}

	}

	hide_nav_btn.addEventListener( 'focusout', hide_nav_btn_tab_to_last_nav_item );

	/*--------------------------------------------------------------
	# RESPONSIVE
	--------------------------------------------------------------*/

	const viewport = window.matchMedia( 'screen and ( max-width:' + Number( header.getAttribute( 'data-nav' ) ) + 'px )' ); /* 'data-nav' is edited in the Customizer. */

	/**
	 * Hides navigation & and toggles event listener on hover.
	 *
	 * Calls function when the user changes the orientation of the device or extends the width of the browser and reaches the breakpoint.
	 *
	 * @since 1.0.0
	 */
	function rwd_hide_nav( mq ) {

		const media_query = mq ? mq : viewport;

		if ( ! media_query.matches ) {

			hide_nav();

			items_arr.forEach(
				function( item ) {

					item.addEventListener( 'mouseenter', toggle_dropdown_on_hover );
					item.addEventListener( 'mouseleave', toggle_dropdown_on_hover );

				}
			);

		} else {

			items_arr.forEach(
				function( item ) {

					item.removeEventListener( 'mouseenter', toggle_dropdown_on_hover );
					item.removeEventListener( 'mouseleave', toggle_dropdown_on_hover );

				}
			);

		}

	}

	rwd_hide_nav();

	window.addEventListener( 'orientationchange', rwd_hide_nav );
	viewport.addListener( function( mq ) { rwd_hide_nav( mq ); } );

} )();
