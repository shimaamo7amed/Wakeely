<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f7f9;
            padding-bottom: 40px;
        }
        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            color: #4a4a4a;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            background-color: #2c3e50;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
            letter-spacing: 2px;
        }
        .content {
            padding: 40px 30px;
            line-height: 1.8;
        }
        .content h2 {
            color: #333;
            font-size: 22px;
            margin-top: 0;
        }
        .otp-container {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 8px;
            color: #2c3e50;
            display: block;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #9b9b9b;
        }
        .btn-notice {
            font-size: 12px;
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <center class="wrapper">
        <table class="main">
            <tr>
                <td class="header">
                    <h1>WAKEELY</h1>
                </td>
            </tr>

            <tr>
                <td class="content">
                    <h2>Verify Your New Email</h2>
                    <p>Hello <strong>{{ $name }}</strong>,</p>
                    <p>We received a request to change the email address associated with your Wakeely account. To complete the process, please use the verification code below:</p>
                    
                    <div class="otp-container">
                        <span class="otp-code">{{ $otp }}</span>
                    </div>

                    <p class="btn-notice">This code will expire in 15 minutes.</p>
                    
                    <p>If you didn't make this request, you can safely ignore this email. Your account remains secure.</p>
                    
                    <p>Best Regards,<br><strong>The Wakeely Team</strong></p>
                </td>
            </tr>

            <tr>
                <td class="footer">
                    <p>&copy; {{ date('Y') }} Wakeely Inc. All rights reserved.</p>
                    <p>This is an automated security notification.</p>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>