<?php
define( 'WP_MEMORY_LIMIT', '256M' );


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
define('DB_NAME', 'dbtz577zh6et5f');

/** MySQL database username */
define('DB_USER', 'u4dbuwahagpxx');

/** MySQL database password */
define('DB_PASSWORD', 'pxrh3kh3gzpg');

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
define('AUTH_KEY',         'kjcxrvt54580zjlasnnt7lm9socsyku60bvn00ti1i2tlckuoh30fah9rvrpmkza');
define('SECURE_AUTH_KEY',  'ynbdn3hsh4p86lthbstrk6xrbwjrsidpx5gdmnjtxridew4opczibgfsze5lheol');
define('LOGGED_IN_KEY',    'rhg32je6wjfxrbqpyuk36bcbl9o6dzfieznqqv4kh7ouajbn96a4iqpqa7tlkvpc');
define('NONCE_KEY',        'awesrtnvrnt7f2rshp31srtqmap95w8mqxtz26wkhzz2bsijwvftcw2qvntiad10');
define('AUTH_SALT',        '3g57emhdtv4quouqzkznfuwtjdwszdhzxq2sgoinp1u0txu7u0ikinld8pw3rsc2');
define('SECURE_AUTH_SALT', 'mfjprmmbud2lc6is2j0nxe9oocsdznuc7wwufcwfv8ywt9wkjpawu4qxr3j4v3pt');
define('LOGGED_IN_SALT',   '6r0jxe3vqy53szovyjnjqbn7l9ulllaksfjzscxbawyxhpnc0p0dvgwxykvetoyn');
define('NONCE_SALT',       'vbwskjg2dbuztk6si38w21vrbpftvwey8jamcxamp2f5h6akw2v8voodatjwf7u6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpdh_';

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


@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system

