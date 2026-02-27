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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'MB/;!mMr*>+GLI}H<7~k4srt4t4pYnsZTT)M/%x?hg67{B)40:Fe;g(6my(2uI4v' );
define( 'SECURE_AUTH_KEY',   'K=^Qr7V|en.y*>|$o!ac~NB;.<l^ b[D;n {zY:vG``Uv68`wWAY_+.@Bo%Qv B]' );
define( 'LOGGED_IN_KEY',     'i>*q$A|IaJMsC(NO=WoM^P#y~>}/YI/JcWV|`{TR34FdQ_)vwiFof*aOD2W3`ow0' );
define( 'NONCE_KEY',         't>,UEL74/!G:#?E.tu~<x#Cctn:X.q+Yx[F>N,j wptNPyd>C $(t$hP nR]V7S(' );
define( 'AUTH_SALT',         ':|]>wjw]=Er3Y4>TSi(`cMqG>X0DW^Dg#**mVT.:>-%tUAcZ2(z7C?gIFy`1oQ}E' );
define( 'SECURE_AUTH_SALT',  'RA<ZSG%$%`3~x.>PG{m,OS*P:wHeMNEM{DXd#jW!zL]Q|6-@@is4yAgF%IBpq8?I' );
define( 'LOGGED_IN_SALT',    'Z_o`*e!lor|;Z$^iCpzF(<rwK]$eaB7%$TTA%=OfegJa~?e_/mN JY##ViK}cuqG' );
define( 'NONCE_SALT',        '-~2Hshuy)[f?1NOG5+tm?*KX~%>//3dTU*p:cxy2N/Eac>Np9(yk+xetsqk,_%-<' );
define( 'WP_CACHE_KEY_SALT', '/7gmE2W4cI7Nx=4-Rsa>VK7y!CD]PDX;e.N|`05O~NqhOY[P7,bfl<6MW@j!A@3H' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
