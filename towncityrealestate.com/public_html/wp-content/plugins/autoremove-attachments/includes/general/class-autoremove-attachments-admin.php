<?php
/**
 * The file that contains the class with the admin functionality
 *
 * @since   1.0.0
 * @package Autoremove_Attachments
 */





/**
 * The admin-specific functionality of the plugin.
 *
 * This class is responsable for maintaining all functions with admin functionality.
 *
 * @since 1.0.0
 */
class Autoremove_Attachments_Admin {

	/**
	 * Initialize the class and get things started.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Nothing yet.
	}





	/**
	 * Remove attachments.
	 *
	 * Get the list of attachments for the post we are about to delete and remove them.
	 *
	 * @since 1.0.0
	 * @param int $post_id ID of the curent post.
	 */
	public function remove_attachments( $post_id ) {
		$autoremove_attachments = get_option( 'autoremove_attachments' );
		$usage_restrictions     = isset( $autoremove_attachments['usage-restrictions'] ) ? $autoremove_attachments['usage-restrictions'] : null;

		if ( $usage_restrictions == 'accept' ) {
			if ( $post_id && $post_id > 0 ) {
				$allowed_to_remove = apply_filters( 'autoremove_attachments_allowed', true );

				if ( $allowed_to_remove ) {
					$args = array(
						'post_type'   => 'attachment',
						'post_parent' => $post_id,
						'post_status' => 'any',
						'nopaging'    => true,

						// Optimize query for performance.
						'no_found_rows'          => true,
						'update_post_meta_cache' => false,
						'update_post_term_cache' => false,
					);
					$query = new WP_Query( $args );

					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();

							wp_delete_attachment( $query->post->ID, true );
						}
					}

					wp_reset_postdata();
				}
			}
		}
	}





	/**
	 * Display a warning about the usage restrictions.
	 *
	 * Display a warning for administrators with the usage restrictions of the plugin.
	 *
	 * @since 1.0.8
	 */
	public function admin_notice() {
		if ( current_user_can( 'manage_options' ) ) {
			$autoremove_attachments = get_option( 'autoremove_attachments' );
			$usage_restrictions     = isset( $autoremove_attachments['usage-restrictions'] ) ? $autoremove_attachments['usage-restrictions'] : null;
			$nonce_url              = wp_nonce_url( '?autoremove_attachments_restrictions=accept', basename( __FILE__ ), 'autoremove_attachments_restrictions_nonce' );
			$faq_url                = 'https://wordpress.org/plugins/autoremove-attachments/faq';

			if ( $usage_restrictions != 'accept' ) {
				?>
					<div class="notice notice-error polygon-notice">
						<p></p>
						<p>
							<b><?php echo esc_html__( 'WARNING: Usage restrictions for media files!', 'autoremove-attachments' ); ?></b>
						</p>
						<p>
							<?php echo esc_html__( 'Autoremove Attachments helps you keep your media library clean by removing all child attachments when the parent post, page or custom post type is deleted.', 'autoremove-attachments' ); ?>
							<br>
							<?php echo esc_html__( 'Since the removal of your media files is irreversible we need to make sure that you understand the limitations of this plugin and the consequences of its improper usage.', 'autoremove-attachments' ); ?>
							<br>
							<?php echo esc_html__( 'That\'s why we highly recommend you read the FAQ section thoroughly before you start using it. The automatic removal of your attachments will work only if you accept the restrictions described in the FAQ.', 'autoremove-attachments' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( $faq_url ); ?>" target="_blank"><b><?php echo esc_html__( 'Read FAQ', 'autoremove-attachments' ); ?></b></a>
							|
							<a href="<?php echo esc_url( $nonce_url ); ?>"><b><?php echo esc_html__( 'Accept Restrictions', 'autoremove-attachments' ); ?></b></a>
						</p>
						<p></p>
					</div>
				<?php
			}
		}
	}





	/**
	 * Hide admin notice.
	 *
	 * Check if the Accept Restrictions button has been clicked and add that to our plugin options.
	 *
	 * @since 1.0.0
	 */
	public function ignore_admin_notice() {
		if ( current_user_can( 'manage_options' ) ) {
			// Variables.
			$autoremove_attachments = get_option( 'autoremove_attachments' );
			$is_nonce_set           = (bool) isset( $_GET['autoremove_attachments_restrictions_nonce'] );

			if ( $is_nonce_set ) {
				$nonce          = sanitize_key( $_GET['autoremove_attachments_restrictions_nonce'] );
				$is_valid_nonce = (bool) wp_verify_nonce( $nonce, basename( __FILE__ ) );
			} else {
				$is_valid_nonce = null;
			}



			// Bail early if the nonce is not set or invalid.
			if ( ! $is_nonce_set || ! $is_valid_nonce ) {
				return;
			}



			// If user clicks the Accept Restrictions button add that to our plugin options.
			if ( isset( $_GET['autoremove_attachments_restrictions'] ) && ( $_GET['autoremove_attachments_restrictions'] == 'accept' ) ) {
				$autoremove_attachments['usage-restrictions'] = 'accept';
				update_option( 'autoremove_attachments', $autoremove_attachments );
			}
		}
	}





	/**
	 * Migrate and update options on plugin updates.
	 *
	 * Compare the current plugin version with the one stored in the options table
	 * and migrate recursively if needed after a plugin update. The migration code for each
	 * version is stored in individual files and it's triggered only if the 'last-updated-version'
	 * parameter is older than versions where changes have been made.
	 *
	 * @since    1.0.0
	 */
	public function maybe_update() {
		$autoremove_attachments = get_option( 'autoremove_attachments' );

		if ( ! isset( $autoremove_attachments['plugin-version'] ) ) {
			$autoremove_attachments['plugin-version'] = AUTOREMOVE_ATTACHMENTS_VERSION;
			update_option( 'autoremove_attachments', $autoremove_attachments );
		}

		if ( ! isset( $autoremove_attachments['last-updated-version'] ) ) {
			$autoremove_attachments['last-updated-version'] = AUTOREMOVE_ATTACHMENTS_VERSION;
			update_option( 'autoremove_attachments', $autoremove_attachments );
		}

		if ( version_compare( AUTOREMOVE_ATTACHMENTS_VERSION, $autoremove_attachments['plugin-version'] ) > 0 ) {
			if ( version_compare( $autoremove_attachments['last-updated-version'], '1.0.8' ) < 0 ) {
				require_once( AUTOREMOVE_ATTACHMENTS_DIR_PATH . 'includes/general/migrate-options/migrate-to-version-1.0.8.php' );
				$autoremove_attachments['last-updated-version'] = '1.0.8';
			}

			/*
			// Migrate options to version 1.1.0.
			if ( version_compare( $autoremove_attachments['last-updated-version'], '1.1.0' ) < 0 ) {
				require_once( AUTOREMOVE_ATTACHMENTS_DIR_PATH . 'includes/general/migrate-options/migrate-to-version-1.1.0.php' );
				$autoremove_attachments['last-updated-version'] = '1.1.0';
			}

			// Migrate options to version 1.2.0.
			if ( version_compare( $autoremove_attachments['last-updated-version'], '1.2.0' ) < 0 ) {
				require_once( AUTOREMOVE_ATTACHMENTS_DIR_PATH . 'includes/general/migrate-options/migrate-to-version-1.2.0.php' );
				$autoremove_attachments['last-updated-version'] = '1.2.0';
			}
			*/



			// Update plugin version.
			$autoremove_attachments['plugin-version'] = AUTOREMOVE_ATTACHMENTS_VERSION;

			// Update plugin options.
			update_option( 'autoremove_attachments', $autoremove_attachments );
		}
	}





	/**
	 * Run activation script for new sites.
	 *
	 * If we are running WordPress Multisite and our plugin is network activated,
	 * run the activation script every time a new site is created.
	 *
	 * @since 1.0.0
	 * @param int    $blog_id Blog ID of the created blog. Optional.
	 * @param int    $user_id User ID of the user creating the blog. Required.
	 * @param string $domain  Domain used for the new blog. Optional.
	 * @param string $path    Path to the new blog. Optional.
	 * @param int    $site_id Site ID. Only relevant on multi-network installs. Optional.
	 * @param array  $meta    Meta data. Used to set initial site options. Optional.
	 */
	public function maybe_activate( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
		if ( $blog_id ) {
			if ( is_plugin_active_for_network( plugin_basename( AUTOREMOVE_ATTACHMENTS_MAIN_FILE ) ) ) {
				switch_to_blog( $blog_id );

				require_once( AUTOREMOVE_ATTACHMENTS_DIR_PATH . 'includes/class-autoremove-attachments-activator.php' );
				Autoremove_Attachments_Activator::run_activation_script();

				restore_current_blog();
			}
		}
	}
}
