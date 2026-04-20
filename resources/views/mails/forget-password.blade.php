<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:20px;">
        <tr>
            <td align="center">

                <!-- Container -->
                <table width="500" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; padding:30px; box-shadow:0 0 10px rgba(0,0,0,0.05);">

                    <!-- Logo -->
                    <tr>
                        <td align="center" style="padding-bottom:20px;">
                        <img src="{{ asset(setting('logo') ?? 'uploads/Settings/logo.webp') }}" width="120">                        </td>
                    </tr>

                    <!-- Title -->
                    <tr>
                        <td align="center" style="color:#3CB7A8; font-size:22px; font-weight:bold; padding-bottom:10px;">
                            Reset Your Password
                        </td>
                    </tr>

                    <!-- Message -->
                    <tr>
                        <td style="color:#555; font-size:14px; line-height:1.6; text-align:center; padding-bottom:20px;">
                            Hello {{ $client->first_name }} {{ $client->last_name }},<br><br>
                            You requested to reset your password. Use the OTP code below to continue.
                        </td>
                    </tr>

                    <!-- OTP Box -->
                    <tr>
                        <td align="center" style="padding:20px 0;">
                            <div style="
                                display:inline-block;
                                padding:15px 30px;
                                font-size:28px;
                                letter-spacing:5px;
                                font-weight:bold;
                                color:#3CB7A8;
                                background:#f1fdfb;
                                border:2px dashed #3CB7A8;
                                border-radius:8px;
                            ">
                                {{ $otp }}
                            </div>
                        </td>
                    </tr>

                    <!-- Expiry -->
                    <tr>
                        <td style="color:#999; font-size:13px; text-align:center; padding-bottom:20px;">
                            This code will expire in 10 minutes.
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="color:#aaa; font-size:12px; text-align:center;">
                            If you didn’t request this, please ignore this email.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>