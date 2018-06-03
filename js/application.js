$('.submit-form').click((e) => {
  e.preventDefault();
  let  name = $('input[name="name"]').val();
  let  email = $('input[name="email"]').val();
  let  phone = $('input[name="phone"]').val();
  let  comments = $('textarea[name="comments"]').val();


  if(name != '' && email != '' && phone != '' && comments != ''){
    $('.contact-error').addClass('hide');
    $('.loader').removeClass('hide');
    $('.contactus-form').hide();
    $.post("../common/form/create.php",
      {
          name, email, phone, comments
      },
      function(data, status){
          if(status=='success'){
            $('.loader').addClass('hide');
            $('.contact-success').removeClass('hide').html('Thank you for reaching out to us. We will get in touch with you shortly.');
          }
          else{
            $('.contact-error').removeClass('hide').html('There is an error occured your request. Please try again.');
          }
      });
  }
  else{
    $('.contact-error').removeClass('hide').html('Please fill the form correctly!');
  }
});