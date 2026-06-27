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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'unrestmx_reform' );

/** Database username */
define( 'DB_USER', 'unrestmx_u' );

/** Database password */
define( 'DB_PASSWORD', 't2=wS?$k;@)[' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'GWFGJ-U1J5Mv]#yBi}YUhQVvD<RM[VK~>:Vj[-:k(:tc0BPNqC/A>0J>6A:gc}@D' );
define( 'SECURE_AUTH_KEY',  '0/_pjIs3:Jk+*nG#PsSeXdKhp`fGYQsS_&<2k!?j^k}EA.!6aL!cP(`p.`xP[CoW' );
define( 'LOGGED_IN_KEY',    'iiW<76N>A?&Kpk?EH-|m7+I/_YMU+%h$y#wsSqjQV9-W~ky:9: 6ahbmAB}HilA~' );
define( 'NONCE_KEY',        'lZS:p(IZ.5gfNq5O_3j3kKke}pa$7s<TD%oZ!8-DB({NZp2vAux~4]/6/]qiHp~~' );
define( 'AUTH_SALT',        's8u;h5k(]5Zq3^_*&3zSCl]39(_Lh?XE`Xw:D%IsP1k#ONy~3w-xbeE |{::f jV' );
define( 'SECURE_AUTH_SALT', 'xEAJ{o5*OK!;/I8b{3W]8%DV7c[}{1|(WGIt6s%hdZMS<A_vdvc)pZxfQ0Lx?yYG' );
define( 'LOGGED_IN_SALT',   'l0e%%+E7q[2Po#hcDD%iJ@Y262}F+T.TSp6d!,5du!SU]u}EJ#fJeiD[MUX49B}b' );
define( 'NONCE_SALT',       'e:g-l?P2_0YUU8@q=00~9O+P)#P^=v|<Z|P8>$,46mH:UV9k&qd&}<Ii<K[L|qjx' );

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

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
