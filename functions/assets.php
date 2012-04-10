<?php

	/**
	 * Register and enqueue scripts and stylesheets
	 */
	function nb_manage_assets() {

		global $pagenow;

		// Register styles
		wp_register_style( 'news-bar-frontend', NB_PLUGIN_URL . '/assets/css/frontend.css', false, NB_PLUGIN_VERSION, 'all' );
		wp_register_style( 'news-bar-frontend-skin', NB_PLUGIN_URL . '/assets/skins/' . nb_get_option('skin') . '.css', false, NB_PLUGIN_VERSION, 'all' );
		wp_register_style( 'news-bar-backend', NB_PLUGIN_URL . '/assets/css/backend.css', false, NB_PLUGIN_VERSION, 'all' );

		// Register scripts
		wp_register_script( 'news-bar-frontend', NB_PLUGIN_URL . '/assets/js/frontend.js', array( 'jquery' ), NB_PLUGIN_VERSION, false );
		wp_register_script( 'news-bar-form', NB_PLUGIN_URL . '/assets/js/form.js', array( 'jquery' ), NB_PLUGIN_VERSION, false );
		wp_register_script( 'news-bar-backend', NB_PLUGIN_URL . '/assets/js/backend.js', array( 'jquery' ), NB_PLUGIN_VERSION, false );

		// Enqueue admin assets
		if ( is_admin() && $pagenow == 'options-general.php' ) {
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_style( 'farbtastic' );
			wp_enqueue_style( 'news-bar-backend' );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_script( 'farbtastic' );
			wp_enqueue_script( 'news-bar-form' );
			wp_enqueue_script( 'news-bar-backend' );
		}

		// Enqueue front-end assets
		elseif ( !is_admin() ) {
			wp_enqueue_style( 'news-bar-frontend' );
			wp_enqueue_style( 'news-bar-frontend-skin' );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'news-bar-frontend' );
		}
	}

	add_action( 'init', 'nb_manage_assets' );
?>