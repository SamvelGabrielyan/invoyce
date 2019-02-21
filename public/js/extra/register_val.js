function validateRePassFrm() {

    jQuery('#new_password_error').hide();
    jQuery('#old_password_error').hide();
  var new_password=jQuery('#new_password').val();
  var con_password=jQuery('#con_password').val();
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
 
function validateRegiFrm() {

      hideProerror();
      var pattern = /^[a-zA-Z0-9\-_]+(\.[a-zA-Z0-9\-_]+)*@[a-z0-9]+(\-[a-z0-9]+)*(\.[a-z0-9]+(\-[a-z0-9]+)*)*\.[a-z]{2,4}$/;
      var fname=jQuery('#fname').val();
     var lname=jQuery('#lname').val();
      var email=jQuery('#reg_email').val();
      var company=jQuery('#company').val();
      var industry=jQuery('#industry').val();
      var password=jQuery('#password').val();


      if(fname.trim()==""){
      jQuery('#fname_error').show();
      jQuery('#fname_error').html("Please enter first name.");
      jQuery('#fname').focus();
      return false;
      }
     if(lname.trim()==""){
      jQuery('#lname_error').show();
      jQuery('#lname_error').html("Please enter last name.");
      jQuery('#lname').focus();
      return false;
      }
      if(company.trim()==""){
      jQuery('#company_error').show();
      jQuery('#company_error').html("Please enter company name.");
      jQuery('#company').focus();
      return false;
      }
      /*if(industry.trim()==""){
      jQuery('#industry_error').show();
      jQuery('#industry_error').html("Please select industry name.");
      jQuery('#industry').focus();
      return false;
      }*/

      if(email.trim()==""){
      jQuery('#reg_email_error').show();
      jQuery('#reg_email_error').html("Please enter email address.");
      jQuery('#reg_email').focus();
      return false;
      }
    if(!(pattern.test(email)))
    {
    jQuery('#reg_email_error').show();
    jQuery('#reg_email_error').html("Please enter valid email address.");
    jQuery('#reg_email').focus();
    return false;
    }

    if(password.trim()=="")
    {
    jQuery('#pass_error').show();
    jQuery('#pass_error').html("Please enter password.");
    jQuery('#password').focus();
    return false;
    }

     if(password.trim()!=""){
     if(password.length<6){
      jQuery('#pass_error').show();
      jQuery('#pass_error').html("Password must be at least 6 characters long.");
      jQuery('#password').focus();
      return false;
      }
      }
 }


 function hideProerror(){

    jQuery('#industry_error').hide();
    jQuery('#fname_error').hide();
    jQuery('#lname_error').hide();
    jQuery('#reg_email_error').hide();
    jQuery('#company_error').hide();
    jQuery('#pass_error').hide();

  }