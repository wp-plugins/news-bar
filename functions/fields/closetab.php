	</table>
	<div class="nb-actions-bar">
		<input type="submit" value="<?php _e( 'Save changes', NB_TEXTDOMAIN ); ?>" class="nb-submit button-primary" />
		<span class="nb-spin"><img src="<?php echo admin_url( 'images/wpspin_light.gif' ); ?>" alt="" /> <?php _e( 'Saving', NB_TEXTDOMAIN ); ?>&hellip;</span>
		<span class="nb-success-tip"><img src="<?php echo NB_PLUGIN_URL . '/assets/images/success.png'; ?>" alt="" /> <?php _e( 'Saved', NB_TEXTDOMAIN ); ?></span>
		<a href="<?php echo NB_PLUGIN_ADMIN; ?>&action=reset" class="nb-reset button alignright" title="<?php _e( 'Reset all settings to default. Are you sure? This action cannot be undone!', NB_TEXTDOMAIN ); ?>"><?php _e( 'Restore default settings', NB_TEXTDOMAIN ); ?></a>
	</div>
</div>