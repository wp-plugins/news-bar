	</table>
	<div class="gndev-plugin-actions-bar">
		<input type="submit" value="<?php _e( 'Save changes', $this->textdomain ); ?>" class="gndev-plugin-submit button-primary" />
		<span class="gndev-plugin-spin"><img src="<?php echo admin_url( 'images/wpspin_light.gif' ); ?>" alt="" /> <?php _e( 'Saving', $this->textdomain ); ?>&hellip;</span>
		<span class="gndev-plugin-success-tip"><img src="<?php echo $this->url . '/assets/images/success.png'; ?>" alt="" /> <?php _e( 'Saved', $this->textdomain ); ?></span>
		<a href="<?php echo $this->admin_url; ?>&action=reset" class="gndev-plugin-reset button alignright" title="<?php _e( 'Reset all settings to default. Are you sure? This action cannot be undone!', $this->textdomain ); ?>"><?php _e( 'Restore default settings', $this->textdomain ); ?></a>
	</div>
</div>