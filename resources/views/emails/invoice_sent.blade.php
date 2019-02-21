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
                                <td class="h1 h1-light-padding" align="center" style="font-family: 'Montserrat', sans-serif; color: #1EB343; font-size: 28px; line-height: 36px; font-weight: bold; padding: 18px 55px;text-transform:uppercase;">Invoice Sent</td>
                            </tr>
                            <tr>
                                <td class="copy" style="font-family: Helvetica, Arial, Sans-Serif; font-size: 16px; line-height: 28px; color: #828282; padding-bottom: 25px; font-weight: 300; padding-left: 55px; padding-right: 55px;">
                                    Hi {{$profile_info->fname}},<br>
                                    The invoice # {{$invoice_data->invoice_number}} has been sent to your customer.
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
                                                <!--[if mso]>&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<![endif]-->
                                                <a href="<?=url('')?>/login" target="_blank"  style="color: #ffffff; display: block; font-size: 16px; font-weight: bold; line-height: 22px; letter-spacing: 1px; max-width: 420px; min-width: 90px; text-align: center; text-decoration: none; text-transform: uppercase; padding: 10px 20px;">Login to Invoyce</a>
                                                <!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<![endif]-->
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- end of .btn -->
                                </td>
                            </tr>
                            <tr>
                                <td class="copy" style="font-family: Helvetica, Arial, Sans-Serif; font-size: 16px; line-height: 28px; color: #828282; padding-bottom: 25px; font-weight: 300; padding-left: 55px; padding-right: 55px;">&nbsp;</td>
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
                                    This email has been sent to you by Invoyce on behalf of {{$profile_info->company}}
                                </td>
                            </tr>
                            <tr>
                                <td class="footerOptions" style="font-family: Helvetica, Arial, Sans-Serif; font-size: 12px; text-align: center;" align="center">
                                    <a href="<?=url('')?>"  style="color: #A8BAC3; text-decoration: none; letter-spacing: 1px; font-weight: bold; text-transform: uppercase; border-bottom-width: 1px; border-bottom-color: #A8BAC3; border-bottom-style: solid; font-size: 10px; line-height: 22px;"><strong><b>Send Invoices for Free</b></strong></a>
                                    <span class="hide-on-device">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a href="<?=url('')?>/privacy"  style="color: #A8BAC3; text-decoration: none; letter-spacing: 1px; font-weight: bold; text-transform: uppercase; border-bottom-width: 1px; border-bottom-color: #A8BAC3; border-bottom-style: solid; font-size: 10px; line-height: 22px;"><strong><b>Privacy Policy</b></strong></a>
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