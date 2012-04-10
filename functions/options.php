<?php

	/**
	 * Available plugin options
	 *
	 * @param string $section
	 * @return array $options Options
	 */
	function nb_get_options() {

		// Get blog categories
		$categories_obj = get_categories( array(
			'hide_empty' => 0,
			'hierarchical' => 1
			) );

		// Create an array with categories
		foreach ( $categories_obj as $category )
			$categories[$category->cat_ID] = $category->cat_name;

		// Get first categry ID
		$categories_ids = array_keys( $categories );
		$first_category = $categories_ids[0];

		/** Available options */
		$options = array(
			array(
				'name' => __( 'Settings', NB_TEXTDOMAIN ),
				'type' => 'opentab'
			),
			array(
				'name' => __( 'News settings', NB_TEXTDOMAIN ),
				'type' => 'title',
			),
			array(
				'name' => __( 'Receive news from', NB_TEXTDOMAIN ),
				'desc' => __( 'Choose news source', NB_TEXTDOMAIN ),
				'options' => array(
					'twitter' => __( 'Twitter', NB_TEXTDOMAIN ),
					'category' => __( 'Blog category', NB_TEXTDOMAIN ),
//					'rss' => __( 'RSS feed', NB_TEXTDOMAIN ),
//					'taxonomy' => __( 'Taxonomy', NB_TEXTDOMAIN ),
				),
				'std' => 'twitter',
				'id' => 'source',
				'type' => 'select',
				'trigger' => true
			),
			array(
				'name' => __( 'Twitter username', NB_TEXTDOMAIN ),
				'desc' => __( 'Enter your twitter username', NB_TEXTDOMAIN ),
				'std' => 'gn_themes',
				'id' => 'twitter',
				'type' => 'text',
				'triggable' => 'source=0'
			),
			array(
				'name' => __( 'Blog category', NB_TEXTDOMAIN ),
				'desc' => __( 'Choose blog category', NB_TEXTDOMAIN ),
				'options' => $categories,
				'std' => $first_category,
				'id' => 'category',
				'type' => 'select',
				'triggable' => 'source=1'
			),
			array(
				'name' => __( 'RSS feed url', NB_TEXTDOMAIN ),
				'desc' => __( 'Enter the url of RSS feed', NB_TEXTDOMAIN ),
				'std' => path_join( home_url(), '?feed=rss2' ),
				'id' => 'rss',
//				'type' => 'text',
				'type' => 'hidden',
				'triggable' => 'source=2'
			),
			array(
				'name' => __( 'Number of items to rotate', NB_TEXTDOMAIN ),
				'desc' => __( 'Select number of news to be showed.<br/>Reccomended value: from 1 to 20', NB_TEXTDOMAIN ),
				'std' => 3,
				'min' => 1,
				'max' => 20,
				'units' => __( 'pc.', NB_TEXTDOMAIN ),
				'id' => 'number',
				'type' => 'number'
			),
			array(
				'name' => __( 'Open links in new window', NB_TEXTDOMAIN ),
				'desc' => __( 'Open ticker links in new window/tab or in the same', NB_TEXTDOMAIN ),
				'std' => 'on',
				'id' => 'links-target',
//				'type' => 'checkbox',
				'type' => 'hidden',
				'label' => __( 'Yes', NB_TEXTDOMAIN )
			),
			array(
				'name' => __( 'Caching', NB_TEXTDOMAIN ),
				'type' => 'title',
			),
			array(
				'name' => __( 'Enable caching <sup>BETA</sup>', NB_TEXTDOMAIN ),
				'desc' => __( 'This option enables caching for feeds.<br/>Be careful with this option.', NB_TEXTDOMAIN ),
				'std' => '',
				'id' => 'cache',
				'type' => 'checkbox',
				'label' => __( 'Enable', NB_TEXTDOMAIN ),
			),
			array(
				'name' => __( 'Animation', NB_TEXTDOMAIN ),
//				'type' => 'title',
				'type' => 'hidden',
			),
			array(
				'name' => __( 'News animation delay', NB_TEXTDOMAIN ),
				'desc' => __( 'Time between ticker animations in milliseconds ( 1000ms = 1sec )', NB_TEXTDOMAIN ),
				'std' => 5000,
				'min' => 50,
				'max' => 100000,
				'units' => __( 'ms', NB_TEXTDOMAIN ),
				'id' => 'delay',
//				'type' => 'number',
				'type' => 'hidden'
			),
			array(
				'name' => __( 'News rotation speed', NB_TEXTDOMAIN ),
				'desc' => __( 'Ticker animation speed in milliseconds ( 1000ms = 1sec )', NB_TEXTDOMAIN ),
				'std' => 600,
				'min' => 50,
				'max' => 10000,
				'units' => __( 'ms', NB_TEXTDOMAIN ),
				'id' => 'speed',
//				'type' => 'number',
				'type' => 'hidden',
			),
			array(
				'name' => __( 'Social icons', NB_TEXTDOMAIN ),
				'type' => 'title',
			),
			array(
				'name' => __( 'Show social icons', NB_TEXTDOMAIN ),
				'desc' => __( 'Show or hide social icons in News Bar', NB_TEXTDOMAIN ),
				'options' => array(
					'true' => __( 'Yes', NB_TEXTDOMAIN ),
					'false' => __( 'No', NB_TEXTDOMAIN )
				),
				'std' => 'true',
				'id' => 'show-social-icons',
				'type' => 'select',
				'trigger' => true
			),
			array(
				'name' => __( 'Open links in new window', NB_TEXTDOMAIN ),
				'desc' => __( 'Open icon links in new window/tab or in the same', NB_TEXTDOMAIN ),
				'std' => 'on',
				'id' => 'social-icons-target',
//				'type' => 'checkbox',
				'type' => 'hidden',
				'label' => __( 'Yes', NB_TEXTDOMAIN ),
				'triggable' => 'show-social-icons=0'
			),
			array(
				'name' => __( 'Icon #1', NB_TEXTDOMAIN ),
				'desc' => __( 'Select social icon and enter the url<br/>Leave url blank to disable icon', NB_TEXTDOMAIN ),
				'std' => array( NB_PLUGIN_URL . '/assets/images/icons/facebook.png', 'http://facebook.com/' ),
				'id' => 'icon-1',
				'type' => 'social-icon',
				'icons' => nb_get_icons(),
				'triggable' => 'show-social-icons=0'
			),
			array(
				'name' => __( 'Icon #2', NB_TEXTDOMAIN ),
				'desc' => __( 'Select social icon and enter the url<br/>Leave url blank to disable icon', NB_TEXTDOMAIN ),
				'std' => array( NB_PLUGIN_URL . '/assets/images/icons/twitter-1.png', 'http://twitter.com/' ),
				'id' => 'icon-2',
				'type' => 'social-icon',
				'icons' => nb_get_icons(),
				'triggable' => 'show-social-icons=0'
			),
			array(
				'name' => __( 'Icon #3', NB_TEXTDOMAIN ),
				'desc' => __( 'Select social icon and enter the url<br/>Leave url blank to disable icon', NB_TEXTDOMAIN ),
				'std' => array( NB_PLUGIN_URL . '/assets/images/icons/youtube.png', 'http://youtube.com/' ),
				'id' => 'icon-3',
				'type' => 'social-icon',
				'icons' => nb_get_icons(),
				'triggable' => 'show-social-icons=0'
			),
			array(
				'name' => __( 'Icon #4', NB_TEXTDOMAIN ),
				'desc' => __( 'Select social icon and enter the url<br/>Leave url blank to disable icon', NB_TEXTDOMAIN ),
				'std' => array( NB_PLUGIN_URL . '/assets/images/icons/vimeo.png', 'http://vimeo.com/' ),
				'id' => 'icon-4',
				'type' => 'social-icon',
				'icons' => nb_get_icons(),
				'triggable' => 'show-social-icons=0'
			),
			array(
				'name' => __( 'Icon #5', NB_TEXTDOMAIN ),
				'desc' => __( 'Select social icon and enter the url<br/>Leave url blank to disable icon', NB_TEXTDOMAIN ),
				'std' => array( NB_PLUGIN_URL . '/assets/images/icons/feed-4.png', 'http://feedburner.com/' ),
				'id' => 'icon-5',
				'type' => 'social-icon',
				'icons' => nb_get_icons(),
				'triggable' => 'show-social-icons=0'
			),
			array(
				'type' => 'closetab'
			),
			array(
				'name' => __( 'Appearance', NB_TEXTDOMAIN ),
				'type' => 'opentab'
			),
			array(
				'name' => __( 'General styling', NB_TEXTDOMAIN ),
				'type' => 'title'
			),
			array(
				'name' => __( 'Show News Bar at', NB_TEXTDOMAIN ),
				'desc' => __( 'Choose where News Bar will be displayed', NB_TEXTDOMAIN ),
				'options' => array(
					'top' => __( 'top of page', NB_TEXTDOMAIN ),
					'bottom' => __( 'bottom of page', NB_TEXTDOMAIN )
				),
				'std' => 'top',
				'id' => 'bar-position',
				'type' => 'select'
			),
			array(
				'name' => __( 'Remove admin bar', NB_TEXTDOMAIN ),
				'desc' => __( 'Default WordPress admin bar will be removed from frontend for all users<br/>It is recommended to enable this option', NB_TEXTDOMAIN ),
				'std' => 'on',
				'id' => 'admin-bar',
				'type' => 'checkbox',
				'label' => __( 'Yes', NB_TEXTDOMAIN )
			),
			array(
				'name' => __( 'News icon', NB_TEXTDOMAIN ),
				'desc' => __( 'Select icon for news (16x16 px)', NB_TEXTDOMAIN ),
				'std' => NB_PLUGIN_URL . '/assets/images/icons/arrow-6.png',
				'id' => 'icon',
				'icons' => nb_get_icons(),
				'type' => 'icon'
			),
			array(
				'name' => __( 'Bar width', NB_TEXTDOMAIN ),
				'desc' => __( 'Specify bar width to fit it to the site', NB_TEXTDOMAIN ),
				'std' => array( 96, '%' ),
				'values' => array( 'px', '%' ), // 'em', 'pt', etc.
				'id' => 'width',
				'min' => 1,
				'max' => 3000,
				'type' => 'size'
			),
			array(
				'name' => __( 'Skin', NB_TEXTDOMAIN ),
				'desc' => __( 'Choose skin for News Bar', NB_TEXTDOMAIN ),
				'options' => array(
					'default' => __( 'Default', NB_TEXTDOMAIN ),
					//'custom' => __( 'Custom skin', NB_TEXTDOMAIN ),
					'glass' => __( 'Glass', NB_TEXTDOMAIN ),
					//'dark-glass' => __( 'Dark glass', NB_TEXTDOMAIN ),
					'wood' => __( 'Wood', NB_TEXTDOMAIN ),
					'dark-wood' => __( 'Dark wood', NB_TEXTDOMAIN ),
					'aluminum' => __( 'Aluminum', NB_TEXTDOMAIN ),
					//'metal' => __( 'Metal', NB_TEXTDOMAIN )
				),
				'std' => 'default',
				'id' => 'skin',
				'type' => 'select',
				'trigger' => true
			),
			array(
				'name' => __( 'Custom skin settings', NB_TEXTDOMAIN ),
//				'type' => 'title',
				'type' => 'hidden',
				'triggable' => 'skin=1'
			),
			array(
				'name' => __( 'Custom skin image', NB_TEXTDOMAIN ),
				'desc' => __( 'Enter the url or upload custom skin image.<br/>Image must be tileable by X-axis', NB_TEXTDOMAIN ),
				'std' => '',
				'id' => 'custom-skin',
//				'type' => 'image',
				'type' => 'hidden',
				'triggable' => 'skin=1'
			),
			array(
				'name' => __( 'Custom skin text color', NB_TEXTDOMAIN ),
				'desc' => __( 'Choose text color for your custom skin', NB_TEXTDOMAIN ),
				'std' => '#777777',
				'id' => 'custom-skin-text',
//				'type' => 'color',
				'type' => 'hidden',
				'triggable' => 'skin=1'
			),
			array(
				'name' => __( 'Custom skin links color', NB_TEXTDOMAIN ),
				'desc' => __( 'Choose links color for your custom skin', NB_TEXTDOMAIN ),
				'std' => '#777777',
				'id' => 'custom-skin-links',
//				'type' => 'color',
				'type' => 'hidden',
				'triggable' => 'skin=1'
			),
			array(
				'name' => __( 'Custom skin links hover color', NB_TEXTDOMAIN ),
				'desc' => __( 'Choose hovered links color for your custom skin', NB_TEXTDOMAIN ),
				'std' => '#777777',
				'id' => 'custom-skin-links-hover',
//				'type' => 'color',
				'type' => 'hidden',
				'triggable' => 'skin=1'
			),
			array(
				'name' => __( 'Advanced settings', NB_TEXTDOMAIN ),
				'type' => 'title',
			),
			array(
				'name' => __( 'CSS position', NB_TEXTDOMAIN ),
				'desc' => __( 'Specify CSS-position property for News Bar', NB_TEXTDOMAIN ),
				'options' => array(
					'fixed' => __( 'Fixed', NB_TEXTDOMAIN ),
					'absolute' => __( 'Absolute', NB_TEXTDOMAIN ),
					'static' => __( 'Static', NB_TEXTDOMAIN )
				),
				'std' => 'fixed',
				'id' => 'position',
//				'type' => 'select',
				'type' => 'hidden',
			),
			array(
				'name' => __( 'Font size', NB_TEXTDOMAIN ),
				'desc' => __( 'Font size for Bews Bar', NB_TEXTDOMAIN ),
				'std' => 13,
				'units' => 'px',
				'id' => 'font-size',
				'min' => 0,
				'max' => 3000,
//				'type' => 'number',
				'type' => 'hidden',
			),
			array(
				'name' => __( 'HTML margin-top', NB_TEXTDOMAIN ),
				'desc' => __( 'Here you can specify margin-top value for HTML tag, if News Bar placed at the top of the page', NB_TEXTDOMAIN ),
				'std' => 32,
				'min' => 0,
				'max' => 1000,
				'units' => 'px',
				'id' => 'margin-top',
				'type' => 'number'
			),
			array(
				'name' => __( 'News Bar z-index', NB_TEXTDOMAIN ),
				'desc' => __( 'Specify z-index CSS-property for News Bar', NB_TEXTDOMAIN ),
				'std' => 20000,
				'min' => 1,
				'max' => 1000000,
				'units' => '',
				'id' => 'z-index',
				'type' => 'number'
			),
			array(
				'type' => 'closetab'
			)
		);

		return $options;
	}

?>