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
define('DB_NAME', 'bitnami_wordpress');

/** MySQL database username */
define('DB_USER', 'bn_wordpress');

/** MySQL database password */
define('DB_PASSWORD', '6a4fbbb38e');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '2faeabaa84729bfc9e643a8dff225da2242654d4c912de98ed25b4aab571b145');
define('SECURE_AUTH_KEY',  '8c7c4f71db29c89b5102946dd04714425e5101b467a2cde4685260fcbd6b0a2c');
define('LOGGED_IN_KEY',    'fad5eb626318e6da308618d6124bf6eb37e8a7910d02231e963907eec474cfe5');
define('NONCE_KEY',        'fea35f8cf3546840b055a11e22ea0fb57ff84b2247064ad6b59a4655e602b925');
define('AUTH_SALT',        '16b1ef6661d3bdf50c8bba111b8868a9aa58b1a68d158c2fbe73265b5fbf73ae');
define('SECURE_AUTH_SALT', 'dfe76d0ce18de05aa5d3bff2475e36c7440b8181fbca212b9e49ee4d52966f4c');
define('LOGGED_IN_SALT',   '386b1f77d52cb3e1c6ec78ad7db08f6e192c19310e437e2385b6c446255e7d1c');
define('NONCE_SALT',       '23b4d753f7b12a4cad6447a15af6b6b52e6ab49d930ee8eb07d4cd02f4f7adab');

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
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
*/

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_TEMP_DIR', 'C:/Bitnami/wampstack-5.5.30-0/apps/wordpress/tmp');

