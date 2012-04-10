// Wait DOM
jQuery(document).ready(function($) {


	// ########## Tabs ##########

	// Nav tab click
	$('#nb-nav-tabs span').click(function(event) {

		// Hide tips
		$('.nb-spin, .nb-success-tip').hide();

		// Remove active class from all tabs
		$('#nb-nav-tabs span').removeClass('nav-tab-active');

		// Hide all panes
		$('.nb-nav-pane').hide();

		// Add active class to current tab
		$(this).addClass('nav-tab-active');

		// Show current pane
		$('.nb-nav-pane:eq(' + $(this).index() + ')').show();

		// Save tab to cookies
		createCookie( 'news_bar_settings_last_tab', $(this).index(), 100 );
	});

	// Auto-open tab by link with hash
	if ( strpos( document.location.hash, '#tab-' ) !== false )
		$('#nb-nav-tabs span:eq(' + document.location.hash.replace('#tab-','') + ')').trigger('click');

	// Auto-open tab by cookies
	else if ( readCookie( 'news_bar_settings_last_tab' ) != null )
		$('#nb-nav-tabs span:eq(' + readCookie( 'news_bar_settings_last_tab' ) + ')').trigger('click');


	// ########## Ajaxed form ##########

	$('#nb-options-form').ajaxForm({
		beforeSubmit: function() {
			$('.nb-success-tip').hide();
			$('.nb-spin').fadeIn(200);
			$('.nb-submit').attr('disabled', true);
		},
		success: function() {
			$('.nb-spin').hide();
			$('.nb-success-tip').show();
			setTimeout(function() {
				$('.nb-success-tip').fadeOut(200);
			}, 2000);
			$('.nb-submit').attr('disabled', false);
		}
	});


	// ########## Reset settings confirmation ##########

	$('.nb-reset').click(function() {
		if (!confirm($(this).attr('title')))
			return false;
		else
			return true;
	});


	// ########## Notifications ##########

	$('.nb-notification').css({
		cursor: 'pointer'
	}).live('click', function(event) {
		$(this).fadeOut(100, function() {
			$(this).remove();
		});
	});


	// ########## Triggables ##########

	// Select
	$('tr[data-trigger-type="select"] select').each(function(i) {

		var // Input data
		name = $(this).attr('name'),
		index = $(this).find(':selected').index();

		//alert( name + ' - ' + index );

		// Hide all related triggables
		$('tr.nb-triggable[data-triggable^="' + name + '="]').hide();

		// Show selected triggable
		$('tr.nb-triggable[data-triggable="' + name + '=' + index + '"]').show();

		$(this).change(function() {

			index = $(this).find(':selected').index();

			// Hide all related triggables
			$('tr.nb-triggable[data-triggable^="' + name + '="]').hide();

			// Show selected triggable
			$('tr.nb-triggable[data-triggable="' + name + '=' + index + '"]').show();
		});
	});

	// Radio
	$('tr[data-trigger-type="radio"] .nb-radio-group').each(function(i) {

		var // Input data
		name = $(this).find(':checked').attr('name'),
		index = $(this).find(':checked').parent('label').parent('div').index();

		// Hide all related triggables
		$('tr.nb-triggable[data-triggable^="' + name + '="]').hide();

		// Show selected triggable
		$('tr.nb-triggable[data-triggable="' + name + '=' + index + '"]').show();

		$(this).find('input:radio').each(function(i2) {

			$(this).change(function() {

				alert();

				// Hide all related triggables
				$('tr.nb-triggable[data-triggable^="' + name + '="]').hide();

				// Show selected triggable
				$('tr.nb-triggable[data-triggable="' + name + '=' + i2 + '"]').show();
			});
		});
	});


	// ########## Clickuts ##########

	$(document).live('click', function(event) {
		if ( $('.nb-prevent-clickout:hover').length == 0 )
			$('.nb-clickout').hide();
	});


	// ########## Icon picker ##########

	// Textfield focus
	$('.nb-icon-picker-value').focus(function(event) {

		event.stopPropagation();

		// Show dropdown
		$(this).parent('.nb-icon-picker').children('.nb-icon-picker-dropdown').show();
	});

	// Textfield blur
	$('.nb-icon-picker-value').blur(function(event) {

		event.stopPropagation();

		var dropdown = jQuery(this).parent('.nb-icon-picker').children('.nb-icon-picker-dropdown');

		// Hide dropdown
		setTimeout(function() {
			dropdown.hide();
		}, 300);
	});

	// Preview icon
	$('.nb-icon-picker-preview').click(function(event) {

		event.stopPropagation();

		$('.nb-icon-picker-dropdown').hide();

		// Show dropdown
		$(this).parent('.nb-icon-picker').children('.nb-icon-picker-dropdown').toggle();
	});

	// Select icon
	$('.nb-icon-picker-dropdown img').click(function(event) {

		event.stopPropagation();

		// Copy image src to textfield
		$(this).parent('.nb-icon-picker-dropdown').parent('.nb-icon-picker').children('.nb-icon-picker-value').val($(this).attr('src'));

		// Copy image src to preview
		$(this).parent('.nb-icon-picker-dropdown').hide().parent('.nb-icon-picker').children('.nb-icon-picker-preview').attr('src',$(this).attr('src'));
	});

	// ########## Upload buttons ##########

	$('.nb-icon-picker-upload, .nb-upload-button').click(function(event) {

		event.stopPropagation();

		// Define upload field
		window.nb_current_upload = $(this).attr('rel');

		// Show thickbox with uploader
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// Prevent click
		event.preventDefault();
	});

	window.send_to_editor = function(html) {
		var url = jQuery('img',html).attr('src');

		// Update upload textfield and icon-picker value
		$('#nb-field-' + window.nb_current_upload).val(url);

		// Update icon-picker preview
		$('.nb-icon-picker-preview[data-id="' + window.nb_current_upload + '"]').attr('src',url);

		// Hide icon-picker dropdown
		$('.nb-icon-picker-dropdown').hide();

		// Hide thickbox
		tb_remove();
	}


	// ########## Color picker ##########

	$('.nb-color-picker-preview').each(function(index) {
		//var id = $(this).attr('data-picker-id');

		$(this).farbtastic('.nb-color-picker-value:eq(' + index + ')');

		$('.nb-color-picker-value:eq(' + index + ')').focus(function(event) {
			$('.nb-color-picker-preview').hide();
			$('.nb-color-picker-preview:eq(' + index + ')').show();
		});
	});

});


// ########## Cookie utilities ##########

function createCookie(name,value,days){
	if(days){
		var date=new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires="; expires="+date.toGMTString()
	}else var expires="";
	document.cookie=name+"="+value+expires+"; path=/"
}
function readCookie(name){
	var nameEQ=name+"=";
	var ca=document.cookie.split(';');
	for(var i=0;i<ca.length;i++){
		var c=ca[i];
		while(c.charAt(0)==' ')c=c.substring(1,c.length);
		if(c.indexOf(nameEQ)==0)return c.substring(nameEQ.length,c.length)
	}
	return null
}
function eraseCookie(name){
	createCookie(name,"",-1)
};


// ########## Strpos tool ##########

function strpos( haystack, needle, offset) {
	var i = haystack.indexOf( needle, offset );
	return i >= 0 ? i : false;
}