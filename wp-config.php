<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordp1' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'C7H/o CG%]J,6/Ae=M)-~m~_u_|U0hf7@>_MMgIi`d6uve@D_`mql=`Hs%[#iFNI' );
define( 'SECURE_AUTH_KEY',  'mT7pv2:}.uT)#i>ezw~^h7FuL%Zm@}IwTnspVV~>]5.+K%`e`o)e@(;2`MkA27%;' );
define( 'LOGGED_IN_KEY',    'vyx<U1Z2]sBZPUlUcy}C?gZzc17>@Gh+`BXBBm(+d%(-W{;nxzN,Q{>;xgX)HlP[' );
define( 'NONCE_KEY',        '[pRJ-Qdlc}2WjSncl`31[tSL&hzQ Tfe. iPzzPYh<p?p:`1+~|(Y{d13ZB~WxIb' );
define( 'AUTH_SALT',        '90_%nopm}81UH4v.|u*7SW5.-`OuOI1`~Lr.!)`f(x]*=Cq!/@S}n^|7#y5$e8mo' );
define( 'SECURE_AUTH_SALT', 'i;ZuAD_(YgJ|sgF`tH-hmL,&YD{`Eu1?S[I}88CjwxZ3,/s-rh!H8G.5q*M$!nGz' );
define( 'LOGGED_IN_SALT',   ',=<Fbc4><cV=JVzDwZ+~f-Iogg[(>-uvP~m#D;uav;vU3|(%+FAJ7THJ&_icFM03' );
define( 'NONCE_SALT',       'nk%nuM3@0Cv yM6(d#k!F96{,8knE7)EP4Ow{|S~3_D|YPxRwQcPE1GLYTo4]%^u' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
