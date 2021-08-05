<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="x-apple-disable-message-reformatting">
    <link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
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
        .kaizen{
            font-family: 'Ma Shan Zheng', cursive;
            /* font-size:  2.5rem !important; */
        }
	</style>
</head>
<body style="margin:0;padding:0;">
    {{-- @json($kaizen) --}}
	<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
		<tr>
			<td align="center" style="padding:0;">
				<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
					<tr>
						<td align="center" style="padding:40px 0 30px 0;background:#ecedf1;">
                            <h1>Kaizen <span class="kaizen">改善</span></h1>
                            {{-- <h1 style="font-size:24px;margin:0 0 5px 0;font-family:Arial,sans-serif;">[#{{$kaizen->id}}] {{$kaizen->title}}</h1> --}}
                            {{-- <img src="{{$message->embed(asset('img/pandorasbox/logo_transparent.png'))}}" alt="" width="300" style="height:auto;display:block;" /> --}}
						</td>
					</tr>
					<tr>
						<td style="padding:36px 30px 42px 30px;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
								<tr>
									<td style="padding:0;color:#05164d;">
                                        @if(!$comment)
                                            <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                                Dear {{$kaizen->required->name}},<br><br>
                                                We would like to acknowledge that we have received your request and a Kaizen has been created.
                                            </p> 
                                        @else
                                            <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                                <span style="color:#6c757d;">{{$comment->user->name}}</span><br>
                                                {!! str_replace("\n","<br>",$comment->comment) !!}
                                            </p> 
                                        
                                        @endif
                                        

                                        <p style="font-size:16px;margin:30px 0 0 0;font-family:Arial,sans-serif;"">
                                            <span style="color:#6c757d">The status of the kaizen is: </span><strong>{{$kaizen->status}}</strong>
                                        </p>
									</td>
									{{-- <td style="padding:0;color:#05164d;">
                                        <h1 style="font-size:15px;margin:0;">Description</h1>
										<p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"> {!! str_replace("\n","<br>",$kaizen->description) !!} </p>
									</td> --}}
								</tr>
							</table>
						</td>
					</tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;background:#ecedf1;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0;color:#05164d;">
                                        <h1 style="font-size:15px;margin:5px 0 0 0;">Group</h1>
                                        <p style="margin:0;font-size:13px;font-family:Arial,sans-serif;">{{$kaizen->group}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;color:#05164d;">
                                        <h1 style="font-size:15px;margin:5px 0 0 0;">Campaign</h1>
                                        <p style="margin:0;font-size:13px;font-family:Arial,sans-serif;">{{$kaizen->campaign}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;color:#05164d;">
                                        <h1 style="font-size:15px;margin:5px 0 0 0;">Type</h1>
                                        <p style="margin:0;font-size:13px;font-family:Arial,sans-serif;">{{$kaizen->type}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;color:#05164d;">
                                        <h1 style="font-size:15px;margin:5px 0 0 0;">Description</h1>
                                        <p style="margin:0;font-size:13px;font-family:Arial,sans-serif;"> {!! str_replace("\n","<br>",$kaizen->description) !!} </p>
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td style="padding:0;width:50%;color:#05164d;" align="left">
                                        <h1 style="font-size:15px;margin:0 0 5px 0;">Corp Email</h1>
                                    </td>
                                    <td style="padding:0;width:50%;color:#6c757d" align="left">
                                        {{$pandora->creator->email}}
                                    </td>
                                </tr> --}}
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