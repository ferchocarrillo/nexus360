<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="x-apple-disable-message-reformatting">
	<title></title>
	<!--[if mso]>
	<noscript>
		<xml>
			<o:OfficeDocumentSettings>
				<o:PixelsPerInch>96</o:PixelsPerInch>
			</o:OfficeDocumentSettings>
		</xml>
	</noscript>
	<![endif]-->
	<style>
		table, td, div, h1, p {font-family: Arial, sans-serif;}
	</style>
</head>
<body style="margin:0;padding:0;">
	<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
		<tr>
			<td align="center" style="padding:0;">
				<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
					<tr>
						<td align="center" style="padding:40px 0 30px 0;background:#ecedf1;">
                            <img src="{{$message->embed(asset('img/pandorasbox/logo_transparent.png'))}}" alt="" width="300" style="height:auto;display:block;" />
						</td>
					</tr>
					<tr>
						<td style="padding:36px 30px 42px 30px;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
								<tr>
									<td style="padding:0;color:#05164d;">
										<h1 style="font-size:24px;margin:0 0 5px 0;font-family:Arial,sans-serif;">{{$pandora->creator->masterfile2[0]->full_name}}</h1>
                                        <h4 style="margin:0 0 20px 0;">Category: {{$pandora->category}}</h4>
										<p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"> {!! str_replace("\n","<br>",$pandora->suggestion) !!} </p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;background:#ecedf1;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0;width:50%;color:#05164d;" align="left">
                                        <h1 style="font-size:15px;margin:0 0 5px 0;">National ID</h1>
                                    </td>
                                    <td style="padding:0;width:50%;color:#6c757d" align="left">
										{{$pandora->creator->masterfile2[0]->national_id}}
									</td>
                                </tr>
                                <tr>
                                    <td style="padding:0;width:50%;color:#05164d;" align="left">
                                        <h1 style="font-size:15px;margin:0 0 5px 0;">Campaign</h1>
                                    </td>
                                    <td style="padding:0;width:50%;color:#6c757d" align="left">
                                        {{$pandora->creator->masterfile2[0]->campaign}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;width:50%;color:#05164d;" align="left">
                                        <h1 style="font-size:15px;margin:0 0 5px 0;">Position</h1>
                                    </td>
                                    <td style="padding:0;width:50%;color:#6c757d" align="left">
                                        {{$pandora->creator->masterfile2[0]->position}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;width:50%;color:#05164d;" align="left">
                                        <h1 style="font-size:15px;margin:0 0 5px 0;">Supervisor</h1>
                                    </td>
                                    <td style="padding:0;width:50%;color:#6c757d" align="left">
                                        {{$pandora->creator->masterfile2[0]->supervisor}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;width:50%;color:#05164d;" align="left">
                                        <h1 style="font-size:15px;margin:0 0 5px 0;">Payroll Manager</h1>
                                    </td>
                                    <td style="padding:0;width:50%;color:#6c757d" align="left">
                                        {{$pandora->creator->masterfile2[0]->payroll_manager}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;width:50%;color:#05164d;" align="left">
                                        <h1 style="font-size:15px;margin:0 0 5px 0;">Corp Email</h1>
                                    </td>
                                    <td style="padding:0;width:50%;color:#6c757d" align="left">
                                        {{$pandora->creator->email}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
					<tr>
						<td style="padding:30px;background:#05164d;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
								<tr>
									<td style="padding:0;width:50%;" align="left">
										<p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
											&reg; Contact Point 360<br/>
										</p>
									</td>
									<td style="padding:0;width:50%;" align="right">
										<table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
											<tr>
												<td style="padding:0 0 0 10px;width:100px;">
													<img src="{{$message->embed(asset('img/CP360_Logo_REV.png'))}}" alt="ContactPoint360" width="100" style="height:auto;display:block;border:0;" />
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>