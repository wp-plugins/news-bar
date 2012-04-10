<?php $triggable = ( $option['triggable'] ) ? ' data-triggable="' . $option['triggable'] . '" class="nb-triggable hide-if-js"' : ''; ?>
<tr<?php echo $triggable; ?>>
	<th scope="row"><label for="nb-field-<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label></th>
	<td>
		<div style="width:300px">
			<input type="text" value="<?php echo $settings[$option['id']]; ?>" name="<?php echo $option['id']; ?>" id="nb-field-<?php echo $option['id']; ?>" class="regular-text" style="width:230px" />
			<a href="#" rel="<?php echo $option['id']; ?>" class="button alignright nb-upload-button hide-if-no-js" style="width:60px;text-align:center;overflow:hidden;padding-left:0;padding-right:0"><?php _e( 'Upload', NB_TEXTDOMAIN ); ?></a>
		</div>
		<span class="description"><?php echo $option['desc']; ?></span>
	</td>
</tr>