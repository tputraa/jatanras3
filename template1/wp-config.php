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
define('DB_NAME', 'develsyn_template1');

/** MySQL database username */
define('DB_USER', 'develsyn_tmp1');

/** MySQL database password */
define('DB_PASSWORD', 'template123456789');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

// Disabled by Performance Manager
define('DISABLE_WP_CRON', 'true');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^)Bwki5?pdj3)h],NOM*~vhm&~P6/AlP*v&#I0,8n=hRSnpovD7kL^gl%5.WUD1M');
define('SECURE_AUTH_KEY',  '+29K!`DRDF7E-wI9~VRe=Y/z~o8S+CqFgSV4zwDHM*IR-5_S7Nmq|(2L9K/a=4pu');
define('LOGGED_IN_KEY',    'lHka+A]!2CTTy.2Dq/;pe,z03.SPU+C9aG3d^70?/JAJit`n5n{c7t2MUFE,Cx(^');
define('NONCE_KEY',        ':SE;CrAm0yEM.:M?Zju1|*e_LyS9p)kI[#ln~$h2oJp~_]/Qg[y(oT#_VuY* H(W');
define('AUTH_SALT',        '}^=pLuUGF5kB2?OaU3%qVh`Q9cF6Yt2>bwZoW#;TD~}YV,7S*-H!e!j}%8=q37[;');
define('SECURE_AUTH_SALT', 'fX2f{%x!7s_s7]x%VrjAuM&+97mxwr<Fdq=#D}bw>@zK)^<&`HKxsRV- +{U)E%8');
define('LOGGED_IN_SALT',   '8jz9x:I QtTr,)kt/o9miKl_U&0^H=3Lt%:-V-RpT?~>jsDC<345m4qe:EdY!t6)');
define('NONCE_SALT',       'd0f).uRUBK$WPvbfmJd0,_W(=DQyn[%YB!5-)2;QC}bx>ItO{[0/o*&pIg/S|TW#');

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
