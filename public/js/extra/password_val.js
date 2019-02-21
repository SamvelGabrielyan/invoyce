function validatePassFrm() {

      hideProerror();

      var old_password=jQuery('#old_password').val();
      var new_password=jQuery('#new_password').val();
      var con_password=jQuery('#con_password').val();


      if(old_password.trim()==""){
      jQuery('#old_password_error').show();
      jQuery('#old_password_error').html("Please enter old password.");
      jQuery('#old_password').focus();
      return false;
      }
      if(new_password.trim()==""){
      jQuery('#new_password_error').show();
      jQuery('#new_password_error').html("Please enter new password.");
      jQuery('#new_password').focus();
      return false;
      }
      if(con_password.trim()==""){
      jQuery('#con_password_error').show();
      jQuery('#con_password_error').html("Please enter confirm password.");
      jQuery('#con_password').focus();
      return false;
      }
          if(new_password.trim()!=con_password.trim()){
          jQuery('#con_password_error').show();
          jQuery('#con_password_error').html("Confirm password doesn't match.");
          jQuery('#con_password').focus();
          return false;
          }

 }


 function hideProerror(){
    jQuery('#con_password_error').hide();
    jQuery('#new_password_error').hide();
    jQuery('#old_password_error').hide();
  }