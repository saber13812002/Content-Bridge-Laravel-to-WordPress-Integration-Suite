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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_01' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '-Z;lHC}-BS#|iOxjAp[sJwiVxW##- Q+~3V+3{oPfF!&44p[tRqPkkHEmA-bzJ6[' );
define( 'SECURE_AUTH_KEY',  'ysW5VwVfj=4]lXD849WM<F(^K>;(`!]+%gY4P4TL Du^ZNsl-o$Lwv;GK,BKZ> Q' );
define( 'LOGGED_IN_KEY',    '__e_)$Va&bH.?2)n2C+^XfT^FG-65YIg@$]6hrJzzXieg*f}DV> NJa|F4*)gq *' );
define( 'NONCE_KEY',        '; *tiaV_B=nt&a|P`xKZkE]=/,%?Irns6EjZ7&?JtO363XH?:>&u42ae(CdlT>IN' );
define( 'AUTH_SALT',        'Kvl@Tz|ikK&8@Ey}vt,+8)d]D^v%A,Kw45~?@p|[2F:)]o05oWV2yex&&[DEvTqT' );
define( 'SECURE_AUTH_SALT', '[~uuOqh5x=QyAn.?y<9vcgP$K d|aYCWaR<a2;<;#Q(>>3Y-T.5W6_3-71KFN!?t' );
define( 'LOGGED_IN_SALT',   'R[K>aQhg8(|*rWrfJ5i$R<,;3}U6Jo.lTI;8H;iu0ac!-:=0@H>j+^-CZ:.O}A*r' );
define( 'NONCE_SALT',       'y]j?f&*9mS<[1=3S/C-6rJsUm?c:5OEMXPUX7a)=G&ua@G5e1dznGirN-olUyyb0' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
// define( 'WP_DEBUG', false );
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true); // این خط خطاها را در فایل debug.log ذخیره می‌کند، اما نمایش نمی‌دهد

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
