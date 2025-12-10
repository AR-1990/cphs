<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
  <title>{{ $subject }}</title>
</head>
<body style="margin:0; padding:0; background:#f4f6f8;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; background:#f4f6f8;">
    <tr>
      <td align="center">
        <table role="presentation" width="800" cellpadding="0" cellspacing="0" style="border-collapse:collapse; width:800px; max-width:800px; font-family:Arial, Helvetica, sans-serif; color:#333333;">
          <tr>
            <td style="background:#ffffff; padding:0;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                <tr>
                  <td style="background:#1c3866; height:6px; line-height:6px; font-size:0;">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" style="padding:22px 24px;">
                    <img src="{{ $message->embed(public_path('admin/images/Final-Logo-Coloured.png')) }}" alt="BIOPHS" style="display:block; height:70px; width:auto;">
                    <div style="margin-top:10px; color:#4a4a4a; font-size:14px; letter-spacing:0.04em;">Bio Informatic Child Preventive Health Services</div>
                  </td>
                </tr>
                <tr>
                  <td style="background:#d86744; height:4px; line-height:4px; font-size:0;">&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="background:#ffffff; padding:24px 28px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                <tr>
                  <td style="padding-bottom:12px; border-bottom:1px solid #e5e5e5;">
                    <div style="margin:0; font-size:22px; color:#1c3866; font-weight:700;">{{ $subject }}</div>
                    <div style="height:3px; width:72px; background:#d86744; margin-top:8px;"></div>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top:16px; font-size:16px; line-height:1.75; color:#2f2f2f;">
                    @php($normalizedMessage = preg_replace('/(\r\n|\r|\n)/', "\n", str_replace(["\\r\\n","\\n","\\r"], "\n", $messageBody)))
                    {!! nl2br(e($normalizedMessage)) !!}
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="background:#ffffff; padding:0 28px 24px 28px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                <tr>
                  <td style="padding-top:12px; border-top:1px solid #eeeeee; font-size:12px; color:#777777;" align="center">
                    <div>© {{ date('Y') }} Biopharma Child Preventive Health Services</div>
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
