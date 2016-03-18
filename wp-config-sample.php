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
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '');

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
define('AUTH_KEY',         'gyH2ZJ|ND<Yi{Nrni3>F% jZ|X!*lx*G&~hpslJ`;qBo|^+>4?yeH@MKM2?/eb-+');
define('SECURE_AUTH_KEY',  'f-Pqet7J41B||M,~iPhRu/[>A.xF`Oo/_Vmvx`CbvW/xAa?SN:)nAE-)cB|-0*8C');
define('LOGGED_IN_KEY',    'EJY%YgE!YA,D|q|Ct0.7-ONDN@IJZiwF(u~eh@8 W!|$obF|0_T(>tQT,lDUyi??');
define('NONCE_KEY',        'F{0_OdyH$#hNHd;t>5-Fv%cap-znIWOSxV?hw.<I,ku)pcM,dnY8DBoZht8%;|gR');
define('AUTH_SALT',        ' Ug_^-nQn[_{&A&Ru0*ENxBBPVJ=_c)|$y*XJ~?=2uEr]E-;gK+3-]6)fCnF7]u]');
define('SECURE_AUTH_SALT', ':d8y3C#IM>UO+x#4uHU*AB0O^):=ODRsC}A-q<}!s8)WUo;hFK}(GL@ct/_VXyOM');
define('LOGGED_IN_SALT',   'UR3>5D/i-V<:KYX 0#:lEzq2lagT+>tPcxTnx9WDH&u(rO|]3PdE7..(1Sz97kp!');
define('NONCE_SALT',       ']b9xVy--Zy@V;8HS&s!yFQM>DM$AbF_7ETB+;<-tk o-so)lUFI]tTcmd cxOI<n');

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
