$(document).on('submit', 'form.js-register', function(event) {
    event.preventDefault();

       let _form = $(this);

       let data = {
           email: $("input[type='email']", _form).val(),
           password: $("input[type='password']", _form).val()
                  }

               console.log(data);
        
    return false;
});