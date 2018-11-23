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
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/data/wwwroot/wordpress/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Liu19931028!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'AbB](3q.GW&Hg*QF(UBxgXA2v1{iGb`|4;>_w <+?S:agyAcx(5X#nq%*:,NH(*p');
define('SECURE_AUTH_KEY',  'Wp,AaXx%1EK@RCHv5y-S]0/sOk1=zDduT#Dg^wejf!(FmeOlZ0:( _rEdwY_XApZ');
define('LOGGED_IN_KEY',    'h#)6aapYO58=<-v0`i{SIh[cO91FSg85y-mj8,33!^,ZH_b2<hP(#OhC263C6sK5');
define('NONCE_KEY',        '$0;rGm1V@ a;_s3 =/-6EF7YK+{#Bi^y_O/vRF7g:IY72S 4$I7+XjdCVf_#X&^6');
define('AUTH_SALT',        'KXadWm<||`<%%@{-B>NdXhB+~<,c+VuGPTS$i`K7NQk_}V5IGV{A9D@TO fbL*y8');
define('SECURE_AUTH_SALT', '!YOy#1v=g&<p6Vbm:)[PPX:/p)WAOt[!U-QyeJ3[}-6<MFF +@EEuTObX)S6x7KH');
define('LOGGED_IN_SALT',   'wkt=u`3!Aj>p~d4H&e`G~3tqj1^qd^arY7xziK+8D>RUq9xe^Xo0_XMJIeWG|WA-');
define('NONCE_SALT',       'yw@$fqujEVky`NGf.Ul!x=IZtGPZL6<yo_YNK|~iJ78rL s9gXs0PbFf{5QaXA8.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
