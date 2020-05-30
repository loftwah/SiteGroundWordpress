<?php
/**
 * The file that contains the core plugin class
 *
 * @since   1.0.0
 * @package Autoremove_Attachments
 */





/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * @since 1.0.0
 */
class Autoremove_Attachments {

	/**
	 * The loader responsible for maintaining and registering all hooks that power the plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    object
	 */
	protected $loader;





	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->load_dependencies();
		$this->set_locale();
		$this->define_hooks();
	}





	/**
	 * Load the required dependencies for the plugin.
	 *
	 * Include the files for the following classes that make up the plugin:
	 *
	 * - Autoremove_Attachments_Loader - Orchestrates the hooks of the plugin.
	 * - Autoremove_Attachments_i18n   - Defines internationalization functionality.
	 * - Autoremove_Attachments_Admin  - Defines all hooks for the admin area.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since     1.0.0
	 * @access    private
	 */
	private function load_dependencies() {
		// Class responsible for orchestrating the actions and filters of the core plugin.
		require_once( AUTOREMOVE_ATTACHMENTS_DIR_PATH . 'includes/class-autoremove-attachments-loader.php' );

		// Class responsible for defining internationalization functionality of the plugin.
		require_once( AUTOREMOVE_ATTACHMENTS_DIR_PATH . 'includes/class-autoremove-attachments-i18n.php' );

		// Class responsible for defining all actions that occur in the admin area.
		require_once( AUTOREMOVE_ATTACHMENTS_DIR_PATH . 'includes/general/class-autoremove-attachments-admin.php' );

		$this->loader = new Autoremove_Attachments_Loader();
	}





	/**
	 * Define locale for internationalization.
	 *
	 * Uses the Autoremove_Attachments_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function set_locale() {
		$plugin_i18n = new Autoremove_Attachments_i18n();

		$this->loader->add_action( 'after_setup_theme', $plugin_i18n, 'load_plugin_textdomain' );
	}





	/**
	 * Register hooks for our plugin.
	 *
	 * Create the objects required for our plugin and register all hooks using the plugin loader.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function define_hooks() {
		// Create objects from classes.
		$plugin_admin  = new Autoremove_Attachments_Admin();

		// Register admin hooks.
		$this->loader->add_action( 'before_delete_post', $plugin_admin, 'remove_attachments' );
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'admin_notice' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'ignore_admin_notice' );
		$this->loader->add_action( 'plugins_loaded', $plugin_admin, 'maybe_update' );
		$this->loader->add_action( 'wpmu_new_blog', $plugin_admin, 'maybe_activate', 10, 6 );
	}





	/**
	 * Run loader and execute all hooks.
	 *
	 * Run the plugin loader and execute all hooks we previously registered inside the function define_hooks().
	 *
	 * @since 1.0.0
	 */
	public function run() {
		$this->loader->run();
	}





	/**
	 * Retrieve the plugin loader.
	 *
	 * Retrieve the object containing all hooks registered by our plugin.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	public function get_loader() {
		return $this->loader;
	}





	/**
	 * Retrieve the plugin name.
	 *
	 * Retrieve the unique identifier of our plugin (slug) and return it as a string.
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_plugin_name() {
		return AUTOREMOVE_ATTACHMENTS_NAME;
	}





	/**
	 * Retrieve the plugin version.
	 *
	 * Retrieve the version of our plugin and return it as a string.
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_version() {
		return AUTOREMOVE_ATTACHMENTS_VERSION;
	}
}
