# Autoremove Attachments
Contributors: PolygonThemes, EusebiuOprinoiu
Tags: attachment, media, post, page, custom post type
Requires at least: 4.5
Tested up to: 5.0
Stable tag: 1.1.2
License: GNU General Public License version 3.0

Remove child attachments when parent post, page or custom post type is deleted.

## Description

Autoremove Attachments helps you keep your media library clean by deleting all media files attached to a post when that post is permanently removed from your database.

By default, WordPress doesn't remove child attachments leaving orphan files behind. Using this plugin you won't have to manually track and remove them.

### Important Notice

Since the removal of your media files is irreversible we need to make sure that you understand the limitations of this plugin and the consequences of its improper usage.

That's why we highly recommend you read the [FAQ section](https://wordpress.org/plugins/autoremove-attachments/faq) thoroughly before you start using it. The automatic removal of your attachments will work only if you accept the restrictions described in the FAQ. ( A notice will be displayed after activating the plugin )

## Installation

### Automatic Installation

The automatic installation is the easiest option to install a plugin as WordPress handles the file transfers itself. To do an automatic install, log in to your WordPress dashboard and follow the steps below:

1. Navigate to the Plugins menu and click "Add New"
2. In the search field type "Autoremove Attachments" and click "Search Plugins"
3. Once you have found the plugin install it by clicking "Install Now"
4. Activate "Autoremove Attachments" from the "Plugins" menu

### Manual Installation

The manual installation method involves downloading the plugin and uploading it on your server via SFTP. To do a manual install follow the steps below:

1. Download the plugin to your local computer
2. If downloaded as a zip archive extract it to your Desktop
3. Upload the plugin folder to the /wp-content/plugins/ directory
4. Activate "Autoremove Attachments" from the "Plugins" menu

## Frequently Asked Questions

### Does it work with custom post types?

Yes, it does. It works with posts, pages and custom post types. All child attachments are removed when the parent post is deleted.

### When are the attachments removed?

The files are removed when the parent post is permanently removed. A soft delete that places your post in Trash will not trigger the removal of your attachments.

The purge happens when you empty your trash.

### Can I control what attachments are removed?

Yes, you can. By default, all media files attached to a post, page or custom post type are removed automatically. If you need granular control you can use the filter `autoremove_attachments_allowed` to define custom rules for controlling when the child attachments should be removed automatically.

Here is an example on how you can remove the attachments only for specific custom post types:

`
function autoremove_attachments_custom_rule() {
	// Global variables.
	global $post_id;

	// Variables.
	$post_type          = get_post_type( $post_id );
	$allowed_post_types = array(
		'project',
		'product',
	);

	// Default return value.
	$allowed_to_remove = false;



	// Custom rules for removing attachments.
	if ( in_array( $post_type, $allowed_post_types ) ) {
		$allowed_to_remove = true;
	}



	// Return.
	return $allowed_to_remove;
}
add_filter( 'autoremove_attachments_allowed', 'autoremove_attachments_custom_rule' );
`

The returned value should be true for the cases in which you want the attachments removed. (false otherwise)

### Are there any restrictions on how I can use my attachments?

Unfortunately, yes! You need to make sure that you don't insert your files into multiple posts. If you do and the parent post is deleted you will end up with missing images.

If you need to use the same image over and over again, upload it from the Media Library ( Media > Add New ). This way the image won't be attached to any post and you will be able to use it without restrictions.

## Changelog

#### Version 1.1.2
- New filter added to allow developers define custom rules for controlling when the child attachments should be removed automatically
- Removed the old 'autoremove_attachments_post_types' filter in favor of the new one - usage instructions available in the FAQ

#### Version 1.1.1
- New filter added to allow developers to change for what post types the child attachments should be removed automatically ( see FAQ for instructions )
- Fixed a minor incompatibility with WP-Sweep

#### Version 1.1.0
- Minor improvements for the admin notice

#### Version 1.0.9
- Performance improvements on websites with a large number of posts and attachments

#### Version 1.0.8
- Added extra security checks before the removal of attachments
- Added an admin notice with a warning about the limitations of this plugin and the consequences of its improper usage. ( for new users only )

#### Version 1.0.7
- Minor code refactoring
- Added full support for WordPress Multisite

#### Version 1.0.6
- Code refactored using wpcs

#### Version 1.0.5
- Improved the warning displayed when very old PHP versions are used

#### Version 1.0.4
- Remove all options on uninstall, even for multisite

#### Version 1.0.3
- Added a security check to avoid deleting attachments when the ID of the parent post is invalid

#### Version 1.0.2
- Fixed a bug that was causing media files to be removed when revisions were deleted with wp-cron

#### Version 1.0.1
- Minimum required version of PHP set to 5.3

#### Version 1.0.0
- First release
