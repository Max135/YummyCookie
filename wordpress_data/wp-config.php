<?php

/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the installation.

 * You don't have to use the web site, you can copy this file to "wp-config.php"

 * and fill in the values.

 *

 * This file contains the following configurations:

 *

 * * Database settings

 * * Secret keys

 * * Database table prefix

 * * ABSPATH

 *

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', '' );


/** Database hostname */

define( 'DB_HOST', 'mariadb:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


/** The database collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );


/**#@+

 * Authentication unique keys and salts.

 *

 * Change these to different unique phrases! You can generate these using

 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.

 *

 * You can change these at any point in time to invalidate all existing cookies.

 * This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define( 'AUTH_KEY',         'sr6M<U0dbAr2rtiHVoOj|Z)|3{~:ERy^*`mfFL^*b]va3`!/m[=C)%ckL;Fx@=}H' );

define( 'SECURE_AUTH_KEY',  'WHV?U26op?Wj{%j+^nGrA]c|3v[*=CMlE1#g1+I;QotG>NIhV~&l%n__1^Vs>[8|' );

define( 'LOGGED_IN_KEY',    '?(QTI,R2s7r~rV&|Vz{{{!rK}ag,1Amp#^@px6mw``p1EYSN/(HY%b^F0X$ T8d<' );

define( 'NONCE_KEY',        '{MlHL;*Mqcf1<r.^c#U);N?Av:zK%xOHD?.;*h}0SyBxrQ.4sN8wY1Mfwd8N0ZAV' );

define( 'AUTH_SALT',        'k4NOqz0]&79h_~`Ym4-<D{ew_ 4xyC:TKM8%hpG>Mb%`*;Aa|O8[*kj_V}i#.p8w' );

define( 'SECURE_AUTH_SALT', '2%5#lP{Zsa,H9aC;KN*gcgEzQitDrKq(I#r}37uXo<vTNss^a0I;3XXSw!3T{{6k' );

define( 'LOGGED_IN_SALT',   'zXPSuqU$iPKV3P+iE{@M(t5T*%)$ j@qD0{|S``uH%D(| ocl|7j)QQpl$Z88S`/' );

define( 'NONCE_SALT',       '7x<&i8OA,+7At:J|}&sD6a#%?q/2wZ%UUH,`MfUM4)@;_887xX}F3}Q0Zgc]LzSa' );


/**#@-*/


/**

 * WordPress database table prefix.

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

 * visit the documentation.

 *

 * @link https://wordpress.org/support/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
