<?php $triggable = ( $option['triggable'] ) ? ' data-triggable="' . $option['triggable'] . '" class="gndev-plugin-triggable hide-if-js"' : ''; ?>
<tr<?php echo $triggable; ?>>
	<th scope="row" colspan="2"><h3 class="gndev-plugin-title-box" style="margin:0"><?php echo $option['name']; ?></h3></th>
</tr>