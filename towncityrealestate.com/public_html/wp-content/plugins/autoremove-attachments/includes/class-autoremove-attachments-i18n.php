<?php
/**
 * The file that contains the class for internationalization
 *
 * @since   1.0.0
 * @package Autoremove_Attachments
 */





/**
 * Define the internationalization functionality.
 *
 * Load and define the internationalization files making the plugin it ready for
 * translation.
 *
 * @since 1.0.0
 */
class Autoremove_Attachments_i18n {

	/**
	 * Initialize the class and get things started.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Nothing yet.
	}





	/**
	 * Load plugin text-domain.
	 *
	 * Load the plugin text-domain for translation from:
	 *
	 * - Global languages folder: wp-content/languages/plugins/autoremove-attachments/autoremove-attachments-en_US.mo
	 * - Local languages folder: wp-content/plugins/autoremove-attachments/languages/autoremove-attachments-en_US.mo
	 *
	 * If no files are found in the global languages folder the plugin uses the files available in the
	 * local folder.
	 *
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'locale', get_locale(), AUTOREMOVE_ATTACHMENTS_NAME );

		// Load textdomain from the global languages folder.
		load_textdomain( AUTOREMOVE_ATTACHMENTS_NAME, trailingslashit( WP_LANG_DIR ) . 'plugins/' . AUTOREMOVE_ATTACHMENTS_NAME . '/' . AUTOREMOVE_ATTACHMENTS_NAME . '-' . $locale . '.mo' );

		// Load textdomain from the local languages folder.
		load_plugin_textdomain( AUTOREMOVE_ATTACHMENTS_NAME, false, plugin_basename( AUTOREMOVE_ATTACHMENTS_DIR_PATH ) . '/languages/' );
	}
}
