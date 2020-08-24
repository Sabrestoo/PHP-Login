$(document).on('submit', 'form.js-register', function(event) {
    event.preventDefault();

       let _form = $(this);

       let _error = $(".js-error", _form);

       let dataObj = {
           email: $("input[type='email']", _form).val(),
           password: $("input[type='password']", _form).val()
                  }
        
        if(dataObj.email.length < 6) {
            _error.text("Please enter a valid email address").show();
            return false;
    } else if(dataObj.password.length < 5) {
        _error.text("please enter a password longer than 4 characters").show();
        return false;
    }
    _error.hide();
      
   $.ajax({
		type: 'POST',
		url: 'php-login/api/register.php',
		data: dataObj,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxDone(data) {
		// Whatever data is 
		if(data.redirect !== undefined) {
			window.location = data.redirect;
		} else if(data.error !== undefined) {
			_error
				.text(data.error)
				.show();
		}
	})
	.fail(function ajaxFailed(e) {
		// This failed 
	})
	.always(function ajaxAlwaysDoThis(data) {
		// Always do
		console.log('Always');
	})

	return false;
});

