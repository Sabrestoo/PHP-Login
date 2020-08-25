
$(document).on('submit', 'form.js-register', function(event) {
    event.preventDefault();

	 let login_url = '/php-login/api/register.php';
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
	 
	fetch(login_url, {
		method: 'POST',
		credentials: 'include',
		headers: {
			'Content-type': 'Application/json'
		},
		body: JSON.stringify(dataObj)
	})
	.then(response => response.json())
	.then(function(data) { 
			if(data.redirect !== undefined) {
				//window.location = data.redirect;
				console.log('Hi');
			} else if(data.error !== undefined) {
				_error
					.text(data.error)
					.show();
			}
		}

).catch((error) => console.log(error));
	});


	//login


	$(document).on('submit', 'form.js-login', function(event) {
		event.preventDefault();
	
		 let url = '/php-login/api/login.php';
		 let _form = $(this);
		 let _error = $(".js-login-error", _form);
	
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
		 
		fetch(url, {
			method: 'POST',
			credentials: 'include',
			headers: {
				'Content-type': 'Application/json'
			},
			body: JSON.stringify(dataObj)
		})
		.then(response => response.json())
		.then(function(data) { 
				if(data.redirect !== undefined) {
					window.location = '/php-login'+ data.redirect;
				} else if(data.error !== undefined) {
					_error
						.html(data.error)
						.show();
				}
			}
	
	).catch((error) => console.log(error));
		});
	

