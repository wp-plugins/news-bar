<?php $triggable = ( $option['triggable'] ) ? ' data-triggable="' . $option['triggable'] . '" class="nb-triggable hide-if-js"' : ''; ?>
<tr<?php echo $triggable; ?>>
	<th scope="row"><label for="nb-field-<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label></th>
	<td>
		<div class="nb-icon-picker">
			<input type="text" value="<?php echo $settings[$option['id']][0]; ?>" name="<?php echo $option['id']; ?>[]" id="nb-field-<?php echo $option['id']; ?>" class="regular-text nb-icon-picker-value nb-prevent-clickout" style="width:270px" />
			<img src="<?php echo $settings[$option['id']][0]; ?>" alt="<?php _e( 'Preview', NB_TEXTDOMAIN ); ?>" class="nb-icon-picker-preview" data-id="<?php echo $option['id']; ?>" /><br/>
			<input type="text" value="<?php echo $settings[$option['id']][1]; ?>" name="<?php echo $option['id']; ?>[]" id="nb-field-2-<?php echo $option['id']; ?>" class="regular-text" style="margin-top:5px" placeholder="<?php _e( 'Enter the url', NB_TEXTDOMAIN ); ?>" />
			<div class="nb-icon-picker-dropdown nb-clickout">
				<?php
					foreach ( $option['icons'] as $icon_id => $icon )
						echo '<img src="' . $icon . '" alt="' . $icon_id . '" title="' . $icon_id . '" />';
				?>
				<a href="#" rel="<?php echo $option['id']; ?>" class="nb-icon-picker-upload"><strong><?php _e( 'Upload custom icon', NB_TEXTDOMAIN ); ?></strong></a>
			</div>
		</div>
		<span class="description"><?php echo $option['desc']; ?></span>
	</td>
</tr>