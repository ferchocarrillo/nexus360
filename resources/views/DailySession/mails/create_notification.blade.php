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
        table,
        td,
        div,
        h1,
        p {
            font-family: Arial, sans-serif;
        }

    </style>
</head>

<body style="margin:0;padding:0;">
    {{-- @json($kaizen) --}}
    <table role="presentation"
        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                    <tr>
                        <td align="center" style="padding:40px 0 30px 0;background:#ecedf1;">
                            <h1>Daily Session</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 30px;color:#05164d;">
                            <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                @if (!$dailySession->acknowledged)
                                    Dear <strong>{{ $dailySession->agent_name }}</strong>,<br><br>
                                    You have a new coaching session waiting for acknowledgment. Please
                                    review
                                    the session information below and access the app to provide your
                                    acknowledgment.
                                @else
                                    The coaching session that you created for the details below has been acknowledged.
                                @endif
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 30px;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="color:#05164d;" align="left">
                                        <h4 style="margin: 0;">Campaign</h4>
                                    </td>
                                    <td style="color:#6c757d" align="left">
                                        {{ $dailySession->campaign }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#05164d;" align="left">
                                        <h4 style="margin:0;">Created by</h4>
                                    </td>
                                    <td style="color:#6c757d" align="left">
                                        {{ $dailySession->creator->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#05164d;" align="left">
                                        <h4 style="margin:0;">Type</h4>
                                    </td>
                                    <td style="color:#6c757d" align="left">
                                        {{ $dailySession->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#05164d;" align="left">
                                        <h4 style="margin:0;">Tactic</h4>
                                    </td>
                                    <td style="color:#6c757d" align="left">
                                        {{ $dailySession->tactic }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#05164d;" align="left">
                                        <h4 style="margin:0;">Behaviour</h4>
                                    </td>
                                    <td style="color:#6c757d" align="left">
                                        {{ $dailySession->behaviour }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#05164d;" align="left">
                                        <h4 style="margin:0;">Metric</h4>
                                    </td>
                                    <td style="color:#6c757d" align="left">
                                        {{ $dailySession->metric }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#05164d;" align="left">
                                        <h4 style="margin:0;">Score</h4>
                                    </td>
                                    <td style="color:#6c757d" align="left">
                                        {{ $dailySession->score }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#05164d;" align="left">
                                        <h4 style="margin:0;">Documented</h4>
                                    </td>
                                    <td style="color:#6c757d" align="left">
                                        {{ $dailySession->documented }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#05164d;" align="left">
                                        <h4 style="margin:0;">Root Cause</h4>
                                    </td>
                                    <td style="color:#6c757d" align="left">
                                        {{ $dailySession->root_cause }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#05164d;" align="left">
                                        <h4 style="margin:0;">Educational Tool</h4>
                                    </td>
                                    <td style="color:#6c757d" align="left">
                                        {{ $dailySession->educational_tool }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#05164d;" align="left" valign="top">
                                        <h4 style="margin:0;">Comments</h4>
                                    </td>
                                    <td style="color:#6c757d" align="left">
                                        {!! str_replace("\n", '<br>', $dailySession->comments) !!}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0;color:#05164d;">
                                        {{-- {{dd($dailySession)}} --}}
                                        <p
                                            style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                            Regards,<br><br>
                                            Reporting Team - Bogota
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;background:#05164d;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                    <td style="padding:0;width:50%;" align="left">
                                        <p
                                            style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                            &reg; Contact Point 360<br />
                                        </p>
                                    </td>
                                    <td style="padding:0;width:50%;" align="right">
                                        <table role="presentation"
                                            style="border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr>
                                                <td style="padding:0 0 0 10px;width:100px;">
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/CP360_logo_REV.png'))) }}"
                                                        alt="ContactPoint360" width="100" height="45"
                                                        style="display:block;border:0;" />
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
