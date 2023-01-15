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
                                Pending Payroll Adjustments
                            </h1>
						</td>
					</tr>
					<tr>
						<td style="padding:36px 30px 42px 30px;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding: 0;">
                                        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr>
                                                <td style="width:260px;padding:0;vertical-align:top;color:#153643; text-align: center;">
                                                    <h1 style="margin-top: 0;margin-bottom: 0;">{{$countOM}}</h1>
                                                    <span>Pending of OM</span>
                                                </td>
                                                <td style="width:20px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
                                                <td style="width:260px;padding:0;vertical-align:top;color:#153643; text-align: center;">
                                                    <h1 style="margin-top: 0;margin-bottom: 0;">{{$countSupervisor}}</h1>
                                                    <span>Pending of Supervisor</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
							</table>
						</td>
					</tr>
                    <tr>
						<td style="padding:36px 30px 42px 30px;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
									<td style="padding:0 0;color:#153643;">
										<table style="width: 100%;border-collapse:collapse;border:0;border-spacing:0;">
											<tr style="background-color: #ecedf1;">
												<th style="padding: 5px;">Supervisor</th>
												<th style="padding: 5px;">Payroll Manager</th>
												<th style="padding: 5px;">Pending For</th>
												<th style="padding: 5px;">Cant</th>
											</tr>

                                            @foreach ($adjustments as $adjustment)
											<tr>
												<td>{{$adjustment->supervisor}}</td>
												<td>{{$adjustment->payroll_manager}}</td>
												<td>{{$adjustment->pending_for}}</td>
												<td>{{$adjustment->cant}}</td>
											</tr>
                                            @endforeach
										</table>
									</td>
								</tr>
                            </table>
						</td>
					</tr>
                    <tr>
						<td style="padding:30px;background-color:#ecedf1;color: #153643;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="width:260px;padding:0;vertical-align:top;text-align: center;">
                                        <h1 style="margin-top: 0;margin-bottom: 0;">{{$total}}</h1>
                                        <span>Total</span>
                                    </td>
                                </tr>
                            </table>
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