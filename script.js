$(function(){

  $.validator.addMethod('strongPassword', function(value, element) {
    return this.optional(element)
      || value.length >= 8
      && /\d/.test(value)
      && /[a-z]/i.test(value);
  }, 'Your password must be at least 8 characters long and contain at least one number and one char\'.')


  $.validator.addMethod('tinlength', function(value, element) {
    return this.optional(element)
      && value.length = 9
  }, 'Tin must be 9 Digits ')

  $.validator.addMethod('supplynumlength', function(value, element) {
    return this.optional(element)
      && value.length = 12
  }, 'Supplynum must be 9 Digits ')

  $("#register-form").validate(
    rules:{
      email:{
        required: true,
        email: true
      },
      password:{
        required: true,
        strongPassword: true
      },
      repassword:{
        required: true.
        equalTo: "#password"
      },
      tin:{
        required: true,
        digits: true,
        tinlength: true
      },
      supplynum:{
        required: true,
        digits: true,
        supplynumlength: true
      },
      messages:{
        email: {
          required: 'Enter an email!',
          email: 'Enter a <em>valid<em> email!'
        }
      }

    }
  );
});
