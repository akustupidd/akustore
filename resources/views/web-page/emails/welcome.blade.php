<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Congratulations on Your Registration</title>
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

        .highlight {
            background-color: #ede9fe;
            color: #6d28d9;
            font-size: 18px;
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

            .highlight {
                font-size: 16px;
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
                            <img src="https://store.akushoping.com/assets-web/images/dark%201.png" alt="Lawliet Store Logo" width="150">

                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td class="content">
                            <h1>Welcome to Lawliet Store!</h1>
                            <p>Dear {{ $customer->name }},</p>
                            <p>Congratulations! You have successfully registered an account with us.</p>
                            <div class="highlight">
                                Your account is now ready to explore our exclusive products and services.
                            </div>
                            <p>Start shopping and enjoy exclusive offers tailored just for you.</p>
                            <p>We’re thrilled to have you on board and can’t wait to provide you with the best shopping experience.</p>
                            <p>If you have any questions or need assistance, feel free to contact our support team.</p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td class="footer">
                            <p>You have received this email because you registered at Lawliet Store. If you did not perform this action, please contact us immediately.</p>
                            <p>© 2025 Lawliet Store. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
