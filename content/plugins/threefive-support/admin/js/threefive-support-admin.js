(function( $ ) {
	'use strict';
	
	$(function(){
		var fieldValues = new Array();

		$( '#threefive-support' ).submit(function(event){
			event.preventDefault();
			
			var data = {
		            action: 'threefive_ajax_send_mail',
		    		email: $('#tf_your_email').val(),
		    		name: $('#tf_your_name').val(),
		    		message: $('#tf_support_request_msg').val()
				},
				submitBtn = $('#tf_support_submit'),
				loader = $('div.loader'),
				messageBox = $('#message-box'),
				successMsg = 'Your request has been submitted successfully. We will review your request and respond shortly.',
				errorMsg = '';

			// Validation			
			// Reset the errors and messages
			fieldValues = []; // Empty the array on each submit
			messageBox.removeClass('error updated').text(''); // Empty and reset the message box
			$('#threefive-support').find('.error').each(function(){
				$(this).removeClass('error');
			});

			// First, check for a valid email address.
			if ( (data.email).indexOf('@') == -1 ) {
				fieldValues.push('false');
				$('#tf_your_email').addClass('error');
				errorMsg = 'Please enter a valid email address.';
				messageBox.addClass('error').text(errorMsg);
				return;
			}

			// Second, check for blank fields.
			$('#threefive-support').find('input.required, textarea.required').each(function() {
				if ( $(this).val() == '' || (data.email).indexOf('@') == -1 ) {
					fieldValues.push('false');
					$(this).addClass('error');
					errorMsg = 'Please fill out all required fields.';
				}
			});
			
			//Lastly, Print the error message for blank fields
			messageBox.addClass('error').text(errorMsg);

			// All systems go!
			if ( $.inArray('false', fieldValues) == '-1' ) {
				submitBtn.attr('disabled', 'disabled');
				loader.addClass('show');
				
				$.ajax({
					url: wpAdminAjax.ajaxurl,
					type: 'POST',
					data: data,
				})
				.done(function() {
					loader.removeClass('show');
					submitBtn.removeAttr('disabled');
					messageBox.removeClass('error').addClass('updated').text(successMsg);
					$('#tf_support_request_msg').val('');
				})
				.fail(function() {
					// console.log("error");
				})
			}
			
		});
	})

})( jQuery );
