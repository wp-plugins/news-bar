<?php

	/*
	  Plugin Name: News Bar
	  Plugin URI: http://gndev.info/news-bar/
	  Version: 1.0.2
	  Author: Vladimir Anokhin
	  Author URI: http://gndev.info/
	  Description: WordPress plugin
	  Text Domain: news-bar
	  Domain Path: /languages
	  License: GPL2
	 */

	/** Plugin version */
	define( 'NB_PLUGIN_VERSION', '1.0.2' );

	/** Plugin textdomain */
	define( 'NB_TEXTDOMAIN', 'news-bar' );

	/** Plugin slug */
	define( 'NB_PLUGIN_SLUG', 'news-bar' );

	/** Plugin URL */
	define( 'NB_PLUGIN_URL', path_join( plugins_url(), NB_PLUGIN_SLUG ) );

	/** Plugin admin URL */
	define( 'NB_PLUGIN_ADMIN', admin_url( 'options-general.php?page=' . NB_PLUGIN_SLUG ) );

	/** Plugin option name */
	define( 'NB_PLUGIN_OPTION', str_replace( '-', '_', NB_PLUGIN_SLUG ) . '_options' );

	/**
	 * Plugin initialization
	 */
	function nb_plugin_init() {

		// Make plugin available for tramslation
		load_plugin_textdomain( NB_TEXTDOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	add_action( 'init', 'nb_plugin_init' );

	/**
	 * Add settings links to plugins dashboard
	 */
	function nb_add_plugins_dashboard_actions( $links ) {
		$links[] = '<a href="' . NB_PLUGIN_ADMIN . '">' . __( 'Settings', NB_TEXTDOMAIN ) . '</a>';
		return $links;
	}

	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'nb_add_plugins_dashboard_actions' );

	// Plugin functions
	require_once 'functions/common.php';

	// Manage options (insert default, save/reset)
	require_once 'functions/options.php';

	// Enqueue assets
	require_once 'functions/assets.php';

	// Backend page
	require_once 'functions/backend.php';

	// WP admin bar config
	require_once 'functions/admin-bar.php';

	// Get news tools
	require_once 'functions/get-news.php';

	// Frontend display
	require_once 'functions/frontend.php';
?>