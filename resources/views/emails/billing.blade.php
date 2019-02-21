@extends('layouts.email')
<table width="100%" id="background" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border: none;" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td valign="top" bgcolor="#ffffff" style="font-family: Helvetica, Arial, Sans-Serif;">
                <table width="600" id="container" align="center" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; table-layout: fixed; margin: 0 auto; border: none;" cellpadding="0" cellspacing="0">
                    <!-- LOGO -->
                    <tbody>
                        <tr>
                            <td valign="middle" align="center" class="hero-row" style="font-family: Helvetica, Arial, Sans-Serif;">
                                <a href="#">
                                <img  alt="" width="200" class="img-flex" style="display: block; margin-top:40px;" data-src-retina="" data-src="https://invoyce.me/dashboard/assets/img/logo_2x.png" src="<?=url('')?>/dashboard/assets/img/logo_2x.png">
                                </a>
                            </td>
                        </tr>
                        <!-- /LOGO -->
                        <tr>
                            <td valign="top" class="hr-bot" style="font-family: Helvetica, Arial, Sans-Serif; border-bottom-width: 1px; border-bottom-color: #F1F3F4; border-bottom-style: solid;">
                                <table width="100%" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border: none;" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td class="h1 h1-light-padding" align="center" style="font-family: &#39;Montserrat&#39;, sans-serif; color: #1EB343; font-size: 28px; line-height: 36px; font-weight: bold; padding: 18px 55px;text-transform:uppercase;">
                                                Billing Information Updated
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                <div style="margin-top:15px;">
                                    <p>Hi {{Auth::user()->first_name.' '.Auth::user()->last_name}},</p>
                                    <p>You have successfully updated the credit card information on Invoyce.</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="copy" style="font-family: Helvetica, Arial, Sans-Serif; font-size: 16px; line-height: 28px; color: #828282; padding-bottom: 25px; font-weight: 300; padding-left: 55px; padding-right: 55px;">&nbsp;</td>
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
                                                    <td class="icon-mid" valign="top" style="font-family: Helvetica, Arial, Sans-Serif; padding: 0 20px;">
                                                        <a href="https://www.facebook.com/invoyceme/"  class="caption" target="_blank" style="color: #828282; text-decoration: none; font-size: 12px; line-height: 20px;">
                                                        <img src="<?=url('')?>/emails/images/facebook-128x128.png" alt="Facebook" title="Facebook" height="30" width="30" style="display: block; outline: none; border: 0;">
                                                        </a>
                                                    </td>
                                                    <td class="icon-left" valign="top" style="font-family: Helvetica, Arial, Sans-Serif;">
                                                        <a href="https://twitter.com/invoyceme/"  class="caption" target="_blank" style="color: #828282; text-decoration: none; font-size: 12px; line-height: 20px;">
                                                        <img src="<?=url('')?>/emails/images/twitter-128x128.png" alt="Twitter" title="Twitter" height="30" width="30" style="display: block; outline: none; border: 0;">
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" id="footer" style="font-family: Helvetica, Arial, Sans-Serif; padding: 35px 35px 36px;">
                                <table width="100%" class="footer-module" align="center" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #A8BAC3; border: none;"
                                    cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td valign="middle" class="corpAddress" style="font-family: Helvetica, Arial, Sans-Serif; font-size: 12px; text-align: center; line-height: 18px; word-break: break-all; padding: 0 0 7px;" align="center"><a href="#" class="corpAddress" target="_blank"  style="color: #A8BAC3; text-decoration: none; font-size: 12px; text-align: center; line-height: 18px; word-break: break-all; padding: 0 0 7px;"><strong><b>Invoyce</b></strong><br>
                                            2121 6th Avenue #N616 Seattle, WA 98121</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="corpAddressCont" style="font-family: Helvetica, Arial, Sans-Serif; font-size: 12px; text-align: center; line-height: 18px !important; padding: 7px 0 31px;" align="center">
                                            This email has been sent to you by Invoyce.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="footerOptions" style="font-family: Helvetica, Arial, Sans-Serif; font-size: 12px; text-align: center;" align="center">
                                            <a href="https://invoyce.me"  style="color: #A8BAC3; text-decoration: none; letter-spacing: 1px; font-weight: bold; text-transform: uppercase; border-bottom-width: 1px; border-bottom-color: #A8BAC3; border-bottom-style: solid; font-size: 10px; line-height: 22px;"><strong><b>Send Invoices for Free</b></strong></a>
                                            <span class="hide-on-device">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="https://invoyce.me/privacy"  style="color: #A8BAC3; text-decoration: none; letter-spacing: 1px; font-weight: bold; text-transform: uppercase; border-bottom-width: 1px; border-bottom-color: #A8BAC3; border-bottom-style: solid; font-size: 10px; line-height: 22px;"><strong><b>Privacy Policy</b></strong></a>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- end of #container -->
            </td>
        </tr>
    </tbody>
</table>