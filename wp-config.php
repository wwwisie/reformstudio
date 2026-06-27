<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
// /** The name of the database for WordPress */
// define( 'DB_NAME', 'reformstudio_db' );

// /** Database username */
// define( 'DB_USER', 'reformstudio_u' );

// /** Database password */
// define( 'DB_PASSWORD', 'Nhex9t#4iNWN' );

// /** Database hostname */
// define( 'DB_HOST', 'localhost' );

// /** Database charset to use in creating database tables. */
// define( 'DB_CHARSET', 'utf8mb4' );

// /** The database collate type. Don't change this if in doubt. */
// define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '.iBQ&?r+h>?=lsB*2g[FHW)eGPIdm>U#F4WN{c!3hPjv1@>Urp[(/gHp$X5%mtBX' );
define( 'SECURE_AUTH_KEY',  '3(.J_V_67u7O9(f,M+--gWP-tI<ChWZLF[@ysCpg%YbV>@#Q^Qn`%}/Z|y2=@tzy' );
define( 'LOGGED_IN_KEY',    'S18fcS.}S_]SUr<hsPTVC29H2]7 $@zQL)^eym,1V#BRrzOE3?K4rc70z7P`-Mdp' );
define( 'NONCE_KEY',        '@JiMP$FI&Na$$x95$[~wmqKA,N7S3G1|:a6-m<F:TWu6Q(hCSP!rch*{J-8?nNe{' );
define( 'AUTH_SALT',        '^4Z?Z&4Hl=]BXwGYR$^i!R0B)HPjT>nyJ]e.6SvpR6QmPk0_JB2hiCwv^i>% }>_' );
define( 'SECURE_AUTH_SALT', 'XT@0*Hu/shc6qvU&l:(vqU;@?Cz@u3ylFI_L+j=M69.n1{,:z*Qy6y&U}jae}^NH' );
define( 'LOGGED_IN_SALT',   '5Sn$MT!c]s&RGM>)}*F[Bx+F])x3Y_-$SM/sDF QI,fiI49iHq!xE>3cM:_91;q=' );
define( 'NONCE_SALT',       'mfzh:C+a>#ySMpoXO]DzO`=<nmZEEZ4 gaNDOWF`{6_f,hlo+z/^*`D}+FN98` ~' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

$ddev_settings = dirname(__FILE__) . '/wp-config-ddev.php';
if (is_readable($ddev_settings) && !defined('DB_USER')) {
  require_once($ddev_settings);
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
