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
define('DB_NAME', 'develsyn_indoukm');

/** MySQL database username */
define('DB_USER', 'develsyn_indoukm');

/** MySQL database password */
define('DB_PASSWORD', 'indoukm123456789');

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
define('AUTH_KEY',         'F7p1F<m8oO{vNv=>A(c;PR;P@7n|~.a1TE)g7W~8UiZ0~6?siIF&LjaK7<5g#nd>');
define('SECURE_AUTH_KEY',  '&:Hd-Zz$@xqS{q?j7~j|aN}N$?L3F=@F<Me>KDp-er4U%i=cB;DPNtkL.HBC4(J1');
define('LOGGED_IN_KEY',    '..X[{nCdS%Yg66a<phS<Os`4^,>Fy/l*q3,kRY9Om-%1M|2p<W|kC-bxr5,]:He=');
define('NONCE_KEY',        'm*)Yste-X}&B`Bs[uVpOX!#,&%9]%S%dram/$tJNzSQ<y(laEp<ykgd+#wmN}4?E');
define('AUTH_SALT',        '2U$AMM]_,#TjMtg9y3+FR)*e@#0M,|W0W9$~.3F:8;@n?qYSOgMSc (_m1`u&Fsp');
define('SECURE_AUTH_SALT', 'D+t<=vxKl#h7db4>8TI_yg?()H`[xnh[8T&;eHO2q9:V0#LBsB8zF~vVKeV)#FOU');
define('LOGGED_IN_SALT',   'rf<nE}-#%H5{b9^rmwm@PBX>>*!{O5*2>mOdBg|KVT{0[aw4EpdGVcwo~43C8Eug');
define('NONCE_SALT',       '}>L<)M7$VBE=x*H9#neqPtUVsn$52v#T~UpPizuX28pb]E/.PS*}!~2i-_a0G;/v');

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
