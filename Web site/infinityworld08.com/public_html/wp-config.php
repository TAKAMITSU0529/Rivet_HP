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
define( 'DB_NAME', 'omusubiya_infini' );

/** Database username */
define( 'DB_USER', 'omusubiya_infini' );

/** Database password */
define( 'DB_PASSWORD', 'zaqxsw33' );

/** Database hostname */
define( 'DB_HOST', 'mysql303b.xserver.jp' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         '6cVxX15I7#HC64<][r899X s+OS^->=UGRB!,gZ?&CFy:vqhN5 PdK2rO@mE|vvw' );
define( 'SECURE_AUTH_KEY',  'D3^}%t1n?-ECJ:.bgb4WI;n@j~E=a>}P%sOhTlSVm0?~eS`:|Igk@VNh-ba:A nw' );
define( 'LOGGED_IN_KEY',    '56ewCe_JDQ6q/SU%8v*yF=#>u4[slHe<J Y$K#Sc:R/*BX?YP}[1MwdhYt9HVx&,' );
define( 'NONCE_KEY',        '^XB#CJ %,Z00o9Os)][p@K|VR1(N1@ 56^ty1;JgnE^P[EZn*{w95LIb#k}w:9~N' );
define( 'AUTH_SALT',        'V5IN/@gv@W-=|%r+yz7u2VFqi-$x4c0OQ~s+_-` NEY)Y,a-nx__?Fv%2o7;|SmG' );
define( 'SECURE_AUTH_SALT', 'T[j?F?qJ!z23b~[]X,E^fZfAC$</$%0x:A|(_QtbZ|Heulng3Ge^U)g$V*oe0LD+' );
define( 'LOGGED_IN_SALT',   '.l,^m,^p-{_eV1Sn^6[Q<[:|N]0xv-M`,IJ7|Z73Z&!9NUb5?dT1{*Eoo%VrpK(z' );
define( 'NONCE_SALT',       'Ek(XK1C~kPNuSdV2KT8dNa0ji:Vo`y~bHiHd1VgJ@S}G#^sELD3iRThiI3;9F~OI' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
