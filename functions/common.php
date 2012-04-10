<?php

	/**
	 * Get option from database
	 *
	 * @param string $option Option name
	 * @return mixed Option value
	 */
	function nb_get_option( $option = false ) {

		// Get options from database
		$options = get_option( NB_PLUGIN_OPTION );

		// Check option is specified
		$value = ( $option ) ? $options[$option] : $options;

		// Return result
		return ( is_array( $value ) ) ? $value : stripslashes( $value );
	}

	/**
	 * Insert default settigns in database
	 */
	function nb_insert_defaults() {

		// Plugin option doesn't exists
		if ( !get_option( NB_PLUGIN_OPTION ) ) {

			// Get options
			$options = nb_get_options();

			// Create array with default options
			$defaults = array( );
			foreach ( $options as $value ) {
				$defaults[$value['id']] = $value['std'];
			}

			// Insert default options
			update_option( NB_PLUGIN_OPTION, $defaults );
		}
	}

	add_action( 'admin_init', 'nb_insert_defaults' );

	/**
	 * Save/reset options action
	 */
	function nb_manage_options() {

		// Save options
		if ( $_POST['action'] == 'save' && $_GET['page'] == NB_PLUGIN_SLUG ) {

			// Prepare variables
			$options = nb_get_options();
			$new_options = array( );

			// Prepare data
			foreach ( $options as $value ) {
				$new_options[$value['id']] = ( is_array( $_POST[$value['id']] ) ) ? $_POST[$value['id']] : htmlspecialchars( $_POST[$value['id']] );
			}

			// Save new options
			if ( update_option( NB_PLUGIN_OPTION, $new_options ) ) {

				// Redirect
				header( 'Location: ' . NB_PLUGIN_ADMIN . '&saved=true' );
			}

			// Options not saved
			else {

				// Redirect
				header( 'Location: ' . NB_PLUGIN_ADMIN . '&saved=false' );
			}
		}

		// Reset options
		elseif ( $_GET['action'] == 'reset' && $_GET['page'] == NB_PLUGIN_SLUG ) {

			// Prepare variables
			$options = nb_get_options();
			$new_options = array( );

			// Prepare data
			foreach ( $options as $value ) {
				$new_options[$value['id']] = $value['std'];
			}

			// Save new options
			if ( update_option( NB_PLUGIN_OPTION, $new_options ) ) {

				// Redirect
				header( 'Location: ' . NB_PLUGIN_ADMIN . '&reseted=true' );
			} else {

				// Redirect
				header( 'Location: ' . NB_PLUGIN_ADMIN . '&reseted=false' );
			}
		}
	}

	add_action( 'admin_init', 'nb_manage_options' );

	/**
	 * Display options fields
	 */
	function nb_display_options() {

		// Get default options
		$options = nb_get_options();

		// Get current settings
		$settings = get_option( NB_PLUGIN_OPTION );

		// Options loop
		foreach ( $options as $option )
			include( 'fields/' . $option['type'] . '.php' );
	}

	function nb_notifications() {

		// No-js message
		?>
		<div class="error nb-notification hide-if-js">
			<p><?php _e( 'For full functionality of this page it is reccomended to enable javascript.', NB_TEXTDOMAIN ); ?> <a href="http://enable-javascript.com/" target="_blank"><?php _e( 'Instructions', NB_TEXTDOMAIN ); ?></a>.</p>
		</div>
		<?php
		// Options reseted
		if ( $_GET['reseted'] == 'true' ) {
			?>
			<div class="updated nb-notification">
				<p><?php _e( 'Settings reseted successfully', NB_TEXTDOMAIN ); ?><small class="hide-if-no-js"><?php _e( 'Click to close', NB_TEXTDOMAIN ); ?></small></p>
			</div>
			<?php
		}

		// Options not reseted
		if ( $_GET['reseted'] == 'false' ) {
			?>
			<div class="error nb-notification">
				<p><?php _e( 'There is already default settings', NB_TEXTDOMAIN ); ?><small class="hide-if-no-js"><?php _e( 'Click to close', NB_TEXTDOMAIN ); ?></small></p>
			</div>
			<?php
		}

		// Saved
		if ( $_GET['saved'] == 'true' ) {
			?>
			<div class="updated nb-notification">
				<p><?php _e( 'Settings saved successfully', NB_TEXTDOMAIN ); ?><small class="hide-if-no-js"><?php _e( 'Click to close', NB_TEXTDOMAIN ); ?></small></p>
			</div>
			<?php
		}

		// No changes
		if ( $_GET['saved'] == 'false' ) {
			?>
			<div class="error nb-notification">
				<p><?php _e( 'Settings not saved, because there is no changes', NB_TEXTDOMAIN ); ?><small class="hide-if-no-js"><?php _e( 'Click to close', NB_TEXTDOMAIN ); ?></small></p>
			</div>
			<?php
		}
	}

	/**
	 * Get available icons
	 */
	function nb_get_icons() {

		// create an array to hold directory list
		$icons = array( );

		// create a handler for the directory
		$handler = opendir( path_join( WP_PLUGIN_DIR, NB_PLUGIN_SLUG . '/assets/images/icons/' ) );

		// open directory and walk through the filenames
		while ( $file = readdir( $handler ) ) {

			// if file isn't this directory or its parent, add it to the results
			if ( $file != "." && $file != ".." ) {
				$name = str_replace( '.png', '', $file );
				$icons[$name] = NB_PLUGIN_URL . '/assets/images/icons/' . $file;
			}
		}

		// tidy up: close the handler
		closedir( $handler );

		// done!
		return $icons;
	}
?>