
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Recovery Code</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f3e8ff;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        .email-wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f3e8ff;
            padding: 20px 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            text-align: center;
            padding: 20px;
            background-color: #f3e8ff;
        }

        .content img {
            height: 30px;
        }

        .content {
            padding: 24px;
        }

        .content h1 {
            color: #4a4a4a;
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 16px;
            text-align: center;
        }

        .content p {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.5;
            margin: 0 0 16px;
        }

        .otp {
            background-color: #ede9fe;
            color: #6d28d9;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 16px;
            border-radius: 8px;
            margin: 0 auto 16px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f3e8ff;
            font-size: 12px;
            color: #6b7280;
        }

        .footer img {
            height: 50px;
            margin-bottom: 10px;
        }

        /* Responsive Styles */
        @media only screen and (max-width: 600px) {
            .content h1 {
                font-size: 20px;
            }

            .content p {
                font-size: 14px;
            }

            .otp {
                font-size: 20px;
                padding: 12px;
            }

            .footer {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <table class="email-wrapper" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <table class="email-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                    <!-- Header -->
                    <tr>
                        <td class="header">
                            <img src="https://store.akushoping.com/assets-web/images/dark%201.png" alt="Lawliet Store Logo" style="width: 150px;" />
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td class="content">
                           
                            <h1>Recovery Code</h1>
                            <p>Here is your login verification code:</p>
                            <div class="otp">{{ $otp }}</div>
                            <p>Please make sure you never share this code with anyone.</p>
                            <p><strong>Note:</strong> The code will expire in 3 minutes.</p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td class="footer">
                            <p>You have received this email because you are registered at Lawliet Store, to ensure the implementation of our Terms of Service and (or) for other legitimate matters.</p>
                            <p>© 2025 Lawliet Store.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
