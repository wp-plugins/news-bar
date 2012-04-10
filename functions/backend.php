<?php

	/**
	 * Register settings page
	 */
	function nb_add_options_page() {
		add_options_page( __( 'News Bar', NB_TEXTDOMAIN ), __( 'News Bar', NB_TEXTDOMAIN ), 'manage_options', NB_PLUGIN_SLUG, 'nb_options_page' );
	}

	add_action( 'admin_menu', 'nb_add_options_page' );

	/**
	 * Settings page
	 */
	function nb_options_page() {
		?>

		<div id="nb-wrapper" class="wrap">
			<div id="icon-options-general" class="icon32 hide-if-no-js"><br /></div>
			<h2 id="nb-nav-tabs" class="nav-tab-wrapper hide-if-no-js">
				<span class="nav-tab nav-tab-active"><?php _e( 'About', NB_TEXTDOMAIN ); ?></span>
				<span class="nav-tab"><?php _e( 'Settings', NB_TEXTDOMAIN ); ?></span>
				<span class="nav-tab"><?php _e( 'Appearance', NB_TEXTDOMAIN ); ?></span>
			</h2>
			<?php nb_notifications(); ?>
			<form action="<?php echo NB_PLUGIN_ADMIN; ?>" method="post" id="nb-options-form">
				<div class="nb-nav-pane">
					<div class="nb-column">
						<h3><?php _e( 'Support', NB_TEXTDOMAIN ); ?></h3>
						<ol style="margin-bottom:30px">
							<li><a href="http://wordpress.org/tags/news-bar?forum_id=10" target="_blank"><?php _e( 'Support forum', NB_TEXTDOMAIN ); ?></a></li>
							<li><a href="http://twitter.com/gn_themes/" target="_blank"><?php _e( 'Author twitter', NB_TEXTDOMAIN ); ?></a></li>
						</ol>
					</div>
					<div class="nb-column">
						<h3><?php _e( 'Do you love this plugin?', NB_TEXTDOMAIN ); ?></h3>
						<ol style="margin-bottom:30px">
							<li><a href="http://wordpress.org/extend/plugins/news-bar/" target="_blank"><?php _e( 'Rate this plugin at wordpress.org', NB_TEXTDOMAIN ); ?></a> (<?php _e( '5 stars', NB_TEXTDOMAIN ); ?>)</li>
							<li><?php _e( 'Review this plugin in your blog', NB_TEXTDOMAIN ); ?></li>
							<li><?php _e( 'Click buttons below', NB_TEXTDOMAIN ); ?></li>
						</ol>
					</div>
					<div class="nb-clear"></div>
					<div class="nb-column">
						<h3><?php _e( 'My other FREE plugins', NB_TEXTDOMAIN ); ?></h3>
						<ol>
							<li><a href="http://wordpress.org/extend/plugins/shortcodes-ultimate/" target="_blank"><?php _e( 'Shortcodes Ultimate', NB_TEXTDOMAIN ); ?></a><span class="description"><?php _e( 'many useful shortcodes', NB_TEXTDOMAIN ); ?></span></li>
							<li><a href="http://wordpress.org/extend/plugins/power-slider/" target="_blank"><?php _e( 'Power slider', NB_TEXTDOMAIN ); ?></a><span class="description"><?php _e( 'customizable slider', NB_TEXTDOMAIN ); ?></span></li>
							<li><a href="http://wordpress.org/extend/plugins/wp-insert-post/" target="_blank"><?php _e( 'WP Insert Post', NB_TEXTDOMAIN ); ?></a><span class="description"><?php _e( 'frontend posting form', NB_TEXTDOMAIN ); ?></span></li>
						</ol>
					</div>
					<div class="nb-column">

						<!-- Twitter -->
						<p><iframe src="http://platform.twitter.com/widgets/tweet_button.html?url=http%3A%2F%2Fgndev.info%2Fnews-bar%2F&amp;via=gn_themes&amp;text=<?php echo str_replace( '+', '%20', urlencode( __( 'Awesome WordPress plugin News Bar', NB_TEXTDOMAIN ) ) );  ?>&amp;lang=en" style="border:none;overflow:hidden;width:105px;height:21px;" scrolling="no"></iframe></p>

						<!-- Facebook -->
						<p><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fgndev.info%2Fnews-bar%2F&amp;send=false&amp;layout=button_count&amp;width=80&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;height=21&amp;locale=en_US" style="border:none;overflow:hidden;width:80px;height:21px;" scrolling="no"></iframe></p>

						<!-- PlusOne -->
						<p><iframe src="https://plusone.google.com/_/+1/fastbutton?url=http%3A%2F%2Fgndev.info%2Fnews-bar%2F&amp;size=medium&amp;count=true&amp;annotation=&amp;hl=en-US" style="border:none;overflow:hidden;width:80px;height:21px;" scrolling="no"></iframe></p>
					</div>
					<div class="nb-clear"></div>
				</div>
				<?php nb_display_options(); ?>
				<input type="hidden" name="action" value="save" />
			</form>
		</div>

		<?php
	}
?>