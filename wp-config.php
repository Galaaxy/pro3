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
define('DB_NAME', 'theme_pro3_2');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'admin');

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
define('AUTH_KEY',         '|Q a^kl?S^t>M#P3S@anS{!tzF7!~.qAhPu(b&waD_e`NU+,L eA+bY0Oe0O@%[o');
define('SECURE_AUTH_KEY',  'S>xF1!4KDt,9Q*7|P=XqoJzNi7(?_?X<T/hiaJ<rGi.)>g?e934<@*erE_39K7fQ');
define('LOGGED_IN_KEY',    '`Mq43]a1&$``}ulx^C7 *t[0>?*vaLv-3*~tn-x1+{ozGNW9+DtStB=lQocy{wE5');
define('NONCE_KEY',        '|Df})5Lje=DCLeJ0C84`nuV)APjJ{D ihx.w,?Mtp`Zcj6UfI3l2CpgOgI6.;Fr4');
define('AUTH_SALT',        'LjhJ)HF)kwsW,FI&5IkLw++(D<$k$*5aksEZ)_|`J|zbq5M^Co[>%/u!Q-7gSd^0');
define('SECURE_AUTH_SALT', 'It=pGHcX0)NV[il>@RDx ie`#qmj,IZpE5%ROL }KEbO3(SS&_a2g)%)GEI]$fa>');
define('LOGGED_IN_SALT',   'N)BVsRCFtB{c4}IAeT@-k/73D>95XF7?or*EM;VVx+&zz])wo9I}|/AtvC=bS)A|');
define('NONCE_SALT',       ')Dyst]i;7FkfatQ#W@1x%*z[f H0Z5is,tKHV|*cf[lVXC79hFM0_(7gEC^@xHH~');

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
