/**
 * Customizer social media.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

jQuery( document ).ready(
	function( $ ) {

		'use strict';

		// Class names.
		const divider       = '|',
		big_divider         = '|___|',
		main_container_dot  = '.custom-customizer-social-media-container',
		main_val_dot        = '.custom-customizer-social-media-final-val',
		items_container_dot = '.custom-customizer-social-media-items-container',
		item_container      = 'custom-customizer-social-media-item-container',
		item_title          = 'custom-customizer-social-media-item-title',
		item_title_dot      = '.custom-customizer-social-media-item-title',
		item_url            = 'custom-customizer-social-media-item-url',
		item_url_dot        = '.custom-customizer-social-media-item-url',
		item_remover        = 'custom-customizer-social-media-item-remover button-primary',
		item_remover_dot    = '.custom-customizer-social-media-item-remover',
		item_increaser_dot  = '.custom-customizer-social-media-item-increaser',
		social_media_arr    = [
			[ 'angellist', 'AngelList', ],
			[ 'bandcamp', 'Bandcamp', ],
			[ 'behance', 'Behance', ],
			[ 'codepen', 'Codepen', ],
			[ 'delicious', 'Delicious', ],
			[ 'deviantart', 'deviantART', ],
			[ 'digg', 'Digg', ],
			[ 'dribbble', 'Dribbble', ],
			[ 'etsy', 'Etsy', ],
			[ 'facebook-f', 'Facebook', ],
			[ 'flickr', 'Flickr', ],
			[ 'foursquare', 'Foursquare', ],
			[ 'google-plus-g', 'Google+', ],
			[ 'houzz', 'Houzz', ],
			[ 'instagram', 'Instagram', ],
			[ 'imdb', 'IMDB', ],
			[ 'lastfm', 'Last.fm', ],
			[ 'linkedin', 'LinkedIn', ],
			[ 'medium', 'Medium', ],
			[ 'meetup', 'Meetup', ],
			[ 'mixcloud', 'Mixcloud', ],
			[ 'odnoklassniki', 'Odnoklassniki', ],
			[ 'pinterest', 'Pinterest', ],
			[ 'product-hunt', 'Product Hunt', ],
			[ 'quora', 'Quora', ],
			[ 'reddit', 'Reddit', ],
			[ 'soundcloud', 'SoundCloud', ],
			[ 'spotify', 'Spotify', ],
			[ 'stack-exchange', 'Stack Exchange', ],
			[ 'stack-overlow', 'Stack Overflow', ],
			[ 'stumbleupon', 'StumbleUpon', ],
			[ 'telegram', 'Telegram', ],
			[ 'tripadvisor', 'TripAdvisor', ],
			[ 'tumblr', 'Tumblr', ],
			[ 'twitter', 'Twitter', ],
			[ 'vimeo', 'Vimeo', ],
			[ 'vine', 'Vine', ],
			[ 'vk', 'VK', ],
			[ 'weibo', 'Weibo', ],
			[ 'yelp', 'Yelp', ],
			[ 'youtube', 'Youtube', ],
		];
 
		function add_fields_value( el ) {

			let final_val = '',
			$el           = $( el ),
			vals          = {
				slug: {
					val: '',
					field: items_container_dot + ' ' + item_title_dot,
				},
				title: {
					val: '',
					field: items_container_dot + ' ' + item_title_dot,
				},
				url: {
					val: '',
					field: items_container_dot + ' ' + item_url_dot,
				},
			};

			Object.keys( vals ).forEach(
				function( key ) {

					$el.find( vals[ key ].field ).each(
						function() {

							const $this = $( this );

							vals[ key ].val += ( key === 'title' ) ? ( social_media_arr[ $this[ 0 ].selectedIndex ][ 1 ] !== 'Select' ? social_media_arr[ $this[ 0 ].selectedIndex ][ 1 ] + divider : '' ) : ( $this.val() ? $this.val() + divider : '');

						}
					);

					final_val += ( key !== 'url' ) ? vals[ key ].val.slice( 0, - 1 ) + big_divider : vals[ key ].val.slice( 0, - 1 );

				}
			);

			$el.find( main_val_dot ).val( final_val ).change();

		}

		function append_content( slug_val = '', url_val = '' ) {

			let selected = '',
			content      = '<div class="' + item_container + '">' + '<select class="' + item_title + '">';

			$( social_media_arr ).each(
				function( i ) {

					selected = ( slug_val === social_media_arr[ i ][ 0 ] ) ? 'selected="selected"' : '';

					content += '<option ' + selected + ' value="' + social_media_arr[ i ][ 0 ] + '">' + social_media_arr[ i ][ 1 ] + '</option>';

				}
			);

			content += '</select>' +
			'<input type="url" value="' + url_val + '" class="' + item_url + '" placeholder="http://">' +
			'<button type="button" class="' + item_remover + '">X</button>' +
			'</div>';

			return content;

		}

		function add_field() {

			const parent = $( this ).parents( main_container_dot );

			$( parent ).find( items_container_dot ).append( append_content() );

		}

		function single_field( e, tag ) {

			const that = tag ? tag : e.target,
			parent     = $( that ).parents( main_container_dot );

			add_fields_value( parent );

		}

		function remove_field() {

			const parent = $( this ).parents( main_container_dot );

			$( this ).parent().remove();
			add_fields_value( parent );

		}

		$( document )
		.on( 'click', item_increaser_dot, add_field )
		.on( 'change', item_title_dot, single_field )
		.on( 'keyup', item_url_dot, single_field )
		.on( 'click', item_remover_dot, remove_field )

		$( main_container_dot ).each(
			function() {

				const that           = $( this ),
				saved_val            = that.find( main_val_dot ).val(),
				saved_val_no_divider = saved_val.replace( big_divider, '' );

				if ( saved_val_no_divider.length > 0 ) {

					const saved_vals = saved_val.split( big_divider ),
					slug_vals        = saved_vals[ 0 ] !== undefined ? saved_vals[ 0 ].split( divider ) : [],
					url_vals         = saved_vals[ 2 ] !== undefined ? saved_vals[ 2 ].split( divider ) : [],
					items_number     = Math.max( slug_vals.length, url_vals.length );
					
					that.find( items_container_dot ).empty();

					for ( let i = 0; i < items_number; i++ ) {

						that.find( items_container_dot ).append( append_content( slug_vals[ i ], url_vals[ i ] ) );

					}

				}

			}

		);

	}
);
