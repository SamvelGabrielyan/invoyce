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
									<img  alt="" width="200" class="img-flex" style="display: block; margin-top:40px;border-radius: 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border: 3px solid #1EB343;" data-src-retina="" data-src="<?=url('')?>/dashboard/assets/img/logo_2x.png" src="<?=url('')?>/dashboard/assets/img/logo_2x.png">
								</a>
							</td>
						</tr>
						<!-- /LOGO -->
						<tr>
							<td valign="top" class="hr-bot" style="font-family: Helvetica, Arial, Sans-Serif; border-bottom-width: 1px; border-bottom-color: #F1F3F4; border-bottom-style: solid;">
								<table width="100%" style="-premailer-border: 0; -premailer-cellpadding: 0; -premailer-cellspacing: 0; border-collapse: collapse; border-spacing: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border: none;" cellpadding="0" cellspacing="0">
									<tbody>
										<tr>
											<td class="h1 h1-light-padding" align="center" style="font-family: &#39;Montserrat&#39;, sans-serif; color: #1EB343; font-size: 28px; line-height: 36px; font-weight: bold; padding: 18px 55px;text-transform:uppercase;">CONTACT FORM MESSAGE</td>
										</tr>
										<tr>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td align="left">
								<div style="margin-top:15px;">
									<p>Hi Invoyce, </p>
									<p>Someone has filled out the contact form on your website. Here are the details:</p>
									<p>
										Name: {{$name}}<br />
										Email: {{$email}} <br />
										Message:{{$message}}<br />
									</p>
								</div>
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
					</tbody>
				</table>
				<!-- end of #container -->
			</td>
		</tr>
	</tbody>
</table>