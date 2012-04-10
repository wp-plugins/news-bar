<?php $triggable = ( $option['triggable'] ) ? ' data-triggable="' . $option['triggable'] . '" class="nb-triggable hide-if-js"' : ''; ?>
<tr<?php echo $triggable; ?>>
	<th scope="row"><label for="nb-field-<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label></th>
	<td>
		<div class="nb-color-picker">
			<input type="text" value="<?php echo $settings[$option['id']]; ?>" name="<?php echo $option['id']; ?>" id="nb-field-<?php echo $option['id']; ?>" class="regular-text nb-color-picker-value nb-prevent-clickout" style="width:90px" />
			<span class="nb-color-picker-preview nb-clickout"></span>
		</div>
		<span class="description"><?php echo $option['desc']; ?></span>
	</td>
</tr>