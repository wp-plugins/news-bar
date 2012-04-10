<?php

	/**
	 * Display news bar
	 */
	function news_bar_display() {

		// Prepare variables
		$option = nb_get_option();
		$styles = '';

		// HTML tag
		$top_value_adminbar = ( ( $option['bar-position'] == 'top' && $option['admin-bar'] == 'on' ) || !is_user_logged_in() ) ? 0 : 28;
		$styles .= ( $option['bar-position'] == 'top' ) ? "html{margin-top:" . ( $option['margin-top'] + $top_value_adminbar ) . "px !important}\n" : "html{margin-bottom:" . $option['margin-top'] . "px !important}\n";

		// Bar styes
		$custom_skin_styles = ( $option['skin'] == 'custom' ) ? ";background:0 0 url('" . $option['custom-skin'] . "');color:" . $option['custom-skin-text'] : "";
		$styles .= ( $option['bar-position'] == 'top' ) ? "#news-bar{position:" . $option['position'] . ";top:" . $top_value_adminbar . "px;z-index:" . $option['z-index'] . ";font-size:" . $option['font-size'] . 'px' . $custom_skin_styles . "}\n" : "#news-bar{position:" . $option['position'] . ";bottom:0px;z-index:" . $option['z-index'] . ";font-size:" . $option['font-size'] . 'px' . $custom_skin_styles . "}\n";

		// Custom skin links color
		$styles .= ( $option['skin'] == 'custom' ) ? "#news-bar-ticker a{color:" . $option['custom-skin-links'] . "}\n#news-bar-ticker a:hover{color:" . $option['custom-skin-links-hover'] . "}\n" : "";

		// Bar shell styes
		$styles .= "#news-bar-shell{width:" . $option['width'][0] . $option['width'][1] . "}\n";

		// Ticker styles
		$styles .= "#news-bar-ticker{background:0 50% url('" . $option['icon'] . "') no-repeat}\n";

		// Single item styles
		$social_icons_margin = ( $option['show-social-icons'] == 'true' ) ? 'margin-right:' . ( news_bar_social_icons( true ) * 32 + 10 ) . 'px' : '';
		$styles .= ".news-bar-item{" . $social_icons_margin . "}\n";

		// Print styles
		echo "<style type='text/css'>" . $styles . "</style>\n";
		?>
		<div id="news-bar">
			<div id="news-bar-shell">
				<div id="news-bar-ticker" data-news-bar-speed="<?php echo $option['speed']; ?>" data-news-bar-delay="<?php echo $option['delay']; ?>">
				<?php news_bar_display_ticker(); ?>
				</div>
				<?php
				if ( $option['show-social-icons'] == 'true' ) {
					?>
					<div id="news-bar-social-icons">
					<?php news_bar_social_icons(); ?>
					</div>
					<?php
				}
				?>
				<div id="news-bar-actions">
					<?php //news_bar_actions();    ?>
				</div>
			</div>
		</div>
		<?php
	}

	add_action( 'wp_footer', 'news_bar_display' );

	/**
	 * News ticker
	 */
	function news_bar_display_ticker() {

		// Prepare veriables
		$output = '';
		$option = nb_get_option();
		$news = array();

		### Twitter
		if ( $option['source'] == 'twitter' )
			$news = nb_get_tweets( $option['twitter'], $option['number'] );

		### RSS feed
		elseif ( $option['source'] == 'rss' )
			$news = nb_get_feed( $option['rss'], $option['number'] );

		### Blog category
		elseif ( $option['source'] == 'category' )
			$news = nb_get_feed( $option['rss'], $option['number'], $option['category'] );

		// Create markup
		foreach ( $news as $content ) {
			$output .= '<div class="news-bar-item">' . $content . '</div>';
		}

		// Print output
		echo $output;
	}

	/**
	 * Social icons
	 */
	function news_bar_social_icons( $count = false ) {

		// Prepare variables
		$option = nb_get_option();
		$icons = array( );
		$target = ( $option['social-icons-target'] == 'on' ) ? ' target="_blank"' : '';
		$output = '';
		$number = 5;

		// Get available icons
		for ( $i = 1; $i <= $number; $i++ ) {
			if ( !empty( $option['icon-' . $i][1] ) )
				$icons[] = $option['icon-' . $i];
		}

		// Create markup
		foreach ( $icons as $icon ) {
			$output .= '<a href="' . $icon[1] . '"' . $target . '><img src="' . $icon[0] . '" alt="" /></a>';
		}

		// Count available icons
		if ( $count )
			return count( $icons );

		// Print result
		else
			echo $output;
	}
?>