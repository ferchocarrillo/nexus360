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
		table, td, div, h1, p {font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;}
	</style>
</head>
<body style="margin:0;padding:0;">
	<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background-color:#ffffff;">
		<tr>
			<td align="center" style="padding:0;">
				<table role="presentation" style="width:805px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
					<tr>
						<td align="center" style="padding:40px 0 30px 0;background-color:#ecedf1;color: #153643;">
                            <h1 style="font-size:24px;margin:0 0 20px 0;">
                                Prenomina Report
                            </h1>
						</td>
					</tr>
					<tr>
						<td style="padding:36px 30px 42px 30px;">
							Report generated {{ date('Y-m-d H:i:s') }}
						</td>
					</tr>
					<tr>
						<td style="padding:30px;background-color:#05164d;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;">
								<tr>
									<td style="padding:0;width:50%;" align="left">
										<p style="margin:0;font-size:14px;line-height:16px;color:#ffffff;">
											&reg; Contact Point 360<br/>
										</p>
									</td>
									<td style="padding:0;width:50%;" align="right">
										<table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
											<tr>
												<td style="padding:0 0 0 10px;width:100px;">
													<img src="data:image/png;base64,{{base64_encode(file_get_contents(public_path('img/CP360_logo_REV.png')))}}" alt="ContactPoint360" width="100" height="45" style="display:block;border:0;"/>
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