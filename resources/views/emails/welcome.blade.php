   @extends('layouts.email')
   <!-- start of #background -->
   <table width="100%" id="background" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border: none;" cellpadding="0" cellspacing="0">
      <tr>
         <td valign="top" bgcolor="#ffffff" style="font-family: Helvetica, Arial, Sans-Serif;">
            <table width="600" id="container" align="center" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; table-layout: fixed; margin: 0 auto; border: none;" cellpadding="0" cellspacing="0">
                <!-- LOGO -->
                <tr>
                    <td valign="top" id="masthead" align="center" style="font-family: Helvetica, Arial, Sans-Serif; padding: 19px 0;">
                        <a href="<?=url('')?>/" target="_blank" style="color: #00B2E2; text-decoration: none;">
                        <img  alt="" width="200" height="" border="0" style="display: block; outline: none; border: 0;" data-src="<?=url('')?>/dashboard/assets/img/logo_2x.png" src="<?=url('')?>/dashboard/assets/img/logo_2x.png">
                        </a>
                    </td>
                </tr>
                <!-- /LOGO -->
               <tr>
                  <td valign="top" class="hr-bot" style="font-family: Helvetica, Arial, Sans-Serif; border-bottom-width: 1px; border-bottom-color: #F1F3F4; border-bottom-style: solid;">
                     <table width="100%" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border: none;" cellpadding="0" cellspacing="0">
                        <tr>
                           <td class="h1 h1-light-padding" align="center" style="font-family: 'Montserrat', sans-serif; color: #1EB343; font-size: 28px; line-height: 36px; font-weight: bold; padding: 18px 55px;text-transform:uppercase;">Welcome to Invoyce!</td>
                        </tr>
                        <tr>
                           <td class="copy" style="font-family: Helvetica, Arial, Sans-Serif; font-size: 16px; line-height: 28px; color: #828282; padding-bottom: 25px; font-weight: 300; padding-left: 55px; padding-right: 55px;"> Hi {{$user_info['first_name'].' '.$user_info['last_name']}},<br>
                              <br>
                              First I want to personally thank you for joining the Invoyce family. My hope is that this invoicing platform saves you time and gets you paid faster. That is the entire reason I built Invoyce. <br>
                              <br>
                              I also want this to be a place where we can help each other out and start to build a community around our businesses. I will be sending out emails with tips and tricks as well as advice from some of the top thinkers in this space. I can't wait to hear what you think of Invoyce! <br>
                              <br>
                              Jon Taggart<br>
                              <strong>Founder</strong>
                           </td>
                        </tr>
                        <tr>
                           <td align="center" style="font-family: Helvetica, Arial, Sans-Serif;">
                              <!-- start of .btn -->
                              <table class="btn btnRounded" style="min-width: 150px; -premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 215px; border: none;"
                                 cellpadding="0" cellspacing="0">
                                 <tr>
                                    <td class="btnTxtCell" height="50" bgcolor="#2DBE60" valign="middle" style="min-width: 150px; line-height: 8px; text-align: center; white-space: nowrap; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; font-family: Helvetica, Arial, Sans-Serif;"
                                       align="center">
                                       <!--[if mso]>&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<![endif]--><a href="{{route('account')}}" target="_blank"  style="color: #ffffff; display: block; font-size: 16px; font-weight: bold; line-height: 22px; letter-spacing: 1px; max-width: 420px; min-width: 90px; text-align: center; text-decoration: none; text-transform: uppercase; padding: 10px 20px;">Setup My Account</a>
                                       <!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<![endif]-->
                                    </td>
                                 </tr>
                              </table>
                              <!-- end of .btn -->
                           </td>
                        </tr>
                        <tr>
                           <td class="copy" style="font-family: Helvetica, Arial, Sans-Serif; font-size: 16px; line-height: 28px; color: ##828282; padding-bottom: 25px; font-weight: 300; padding-left: 55px; padding-right: 55px;">&nbsp;</td>
                        </tr>
                     </table>
                  </td>
               </tr>
               <tr>
                  <td valign="middle" class="hr-bot section-padding" bgcolor="#fbfcfd" style="font-family: Helvetica, Arial, Sans-Serif; border-bottom-width: 1px; border-bottom-color: #F1F3F4; border-bottom-style: solid; padding: 27px 25px;">
                     <table width="100%" class="download-module" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border: none;" cellpadding="0"
                        cellspacing="0">
                        <tr>
                           <td valign="middle" style="font-family: Helvetica, Arial, Sans-Serif;">
                              <table width="366" align="center" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0 auto; border: none;" cellpadding="0"
                                 cellspacing="0">
                                 <tr>
                                    <td valign="middle" class="txt" style="font-family: Helvetica, Arial, Sans-Serif; font-size: 16px; color: #8B8B8B; text-align: center; font-weight: 300; letter-spacing: 0.4px; padding: 0 0 19px;" align="center">Have Questions?</td>
                                 </tr>
                                 <tr>
                                    <td valign="middle" align="center" style="font-family: Helvetica, Arial, Sans-Serif;">
                                 <tr>
                                    <td class="copy" align="center" style="font-family: Helvetica, Arial, Sans-Serif; font-size: 16px; line-height: 28px; color: #1EB343; padding-bottom: 25px; font-weight: 300; ">help@invoyce.me</td>
                                 </tr>
                                 </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
               <tr>
                  <td valign="middle" class="hr-bot" style="font-family: Helvetica, Arial, Sans-Serif; border-bottom-width: 1px; border-bottom-color: #F1F3F4; border-bottom-style: solid;">
                     <table width="100%" class="social-module" align="center" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border: none;"
                        cellpadding="0" cellspacing="0">
                        <tr>
                           <td valign="middle" class="social-module-cell" style="font-family: Helvetica, Arial, Sans-Serif; padding: 33px 25px 26px;">
                              <table width="74%" class="txt-table" align="left" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border: none;" cellpadding="0"
                                 cellspacing="0">
                                 <tr>
                                    <td valign="middle" class="text" height="30" style="font-family: Helvetica, Arial, Sans-Serif; letter-spacing: 1px; color: #8B8B8B; font-size: 14px; line-height: 24px; font-weight: 300; padding-right: 24px; text-align: right;" align="right">Like us and Follow us for the latest news:</td>
                                 </tr>
                              </table>
                              <table width="25%" class="icon-table" align="right" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border: none;"
                                 cellpadding="0" cellspacing="0">
                                 <tr>
                                    <td class="icon-mid" valign="top" style="font-family: Helvetica, Arial, Sans-Serif; padding: 0 20px;"><a href="https://www.facebook.com/invoyceme/"  class="caption" target="_blank" style="color: #828282; text-decoration: none; font-size: 12px; line-height: 20px;"> <img src="{{url('/emails/images/facebook-128x128.png')}}" alt="Facebook" title="Facebook" height="30" width="30" style="display: block; outline: none; border: 0;"> </a></td>
                                    <td class="icon-left" valign="top" style="font-family: Helvetica, Arial, Sans-Serif;"><a href="https://twitter.com/invoyceme/"  class="caption" target="_blank" style="color: #828282; text-decoration: none; font-size: 12px; line-height: 20px;"> <img src="{{url('/emails/images/twitter-128x128.png')}}" alt="Twitter" title="Twitter" height="30" width="30" style="display: block; outline: none; border: 0;"> </a></td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
            <!-- end of #container -->
         </td>
      </tr>
   </table>
   <!-- end of #background -->