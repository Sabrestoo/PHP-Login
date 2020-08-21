$(document).on('submit', 'form.js-register', function(event) {
    event.preventDefault();

       let _form = $(this);

       let _error = $(".js-error", _form);

       let data = {
           email: $("input[type='email']", _form).val(),
           password: $("input[type='password']", _form).val()
                  }

        
                  if(data.email.length < 6) {
                      _error.text("Please enter a valid email address").show();
                      return false;
                } else if(data.password.length < 5) {
                    _error.text("please enter a password longer than 4 characters").show();
                    return false;
                }

                _error.hide();

        fetch('/php-login/api/register.php', 
        {
            method: 'POST',
            mode:    'cors',
            headers: {
                'Content-Type': 'application/json',  
                'Accept':       'application/json'   
              },
            body: JSON.stringify({min: 1, max: 100})
        })
                .then((response) => response.json())
                .then(function(data) {
                    
                })
                .catch(function(error){

                });
        
    return false;
});