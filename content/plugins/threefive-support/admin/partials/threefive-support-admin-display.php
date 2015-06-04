<?php

/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://3five.com
 * @since      1.0.0
 *
 * @package    Threefive_Support
 * @subpackage Threefive_Support/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php 
	$current_user = wp_get_current_user();

	$email = $current_user->user_email;
	$name = $current_user->display_name;
?>
<div id="support-form-header">
	<h1>We're here to help.</h1>
	<p>Did you find a bug? <br>
	Do you need help updating your website?<br>
	Did something break?<br>
	Do you have an idea to improve your website?</p>
	<p>Use the form below to submit a support ticket to 3five, Inc.'s Support team. We'll respond to your inquiry usually within 1 business day. **</p>
</div>

<div id="message-box" class=""></div>

<form id="threefive-support" enctype="multipart/form-data">
	<div class="input-text-wrap">
		<label for="tf_your_email">
			Email <span class="is-required">*</span>
			<input type="text" name="tf_your_email" id="tf_your_email" class="required" placeholder="Email" value="<?php if( !empty($email) ? _e($email) : '' );?>">
		</label>
	</div>
	
	<div class="input-text-wrap">
		<label for="tf_your_name">
			Name <span class="is-required">*</span>
			<input type="text" name="tf_your_name" id="tf_your_name" class="required" placeholder="Name" value="<?php if( !empty($name) ? _e($name) : '' );?>">
		</label>
	</div>
	
	<div id="description-wrap" class="textarea-wrap">
		<label for="tf_support_request_msg">
			Your Request <span class="is-required">*</span>
			<textarea name="tf_support_request_msg" id="tf_support_request_msg" class="required" cols="15" rows="6" placeholder="What can we help you with?"></textarea>
		</label>
	</div>

	<input type="submit" name="tf_support_submit" id="tf_support_submit" class="button button-primary button-hero" value="Get Support">
	<div class="loader"></div>

	<div id="disclaimer">
		<p>** Remember that all support requests and questions are subject to our billable hourly rate unless you have arranged a maintenance contract. Time is tracked in 15 minute increments and billed monthly.</p>
	</div>
</form>