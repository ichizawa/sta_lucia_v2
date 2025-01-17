<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>Award Notice - Sta Lucia Mall</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fb;
            margin: 0;
            padding: 0;
        }

        .letter_container {
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-top: 8px solid #4CAF50;
        }

        .letter_header {
            text-align: center;
            margin-bottom: 30px;
        }

        .letter_header img {
            max-width: 120px;
            margin-bottom: 15px;
        }

        .letter_header h1 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-top: 10px;
        }

        .approved_banner {
            background: #4CAF50;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            color: white;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 25px;
        }

        .approved_banner i {
            font-size: 35px;
            margin-right: 15px;
        }

        .pending_banner {
            background: #ff9800;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            color: white;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 25px;
        }

        .pending_banner i {
            font-size: 35px;
            margin-right: 15px;
        }

        .letter_body {
            font-size: 16px;
            line-height: 1.7;
            color: #555;
            margin-bottom: 30px;
        }

        .letter_body p {
            margin: 15px 0;
        }

        .signature {
            margin-top: 40px;
            line-height: 0.6;
        }

        .letter_footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
            margin-top: 40px;
        }

        .letter_footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="letter_container">
        <div class="letter_header">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/assets/img/sta_lucia_logo2.png'))) }}" alt="Logo">
            <h1>Award Notice</h1>
        </div>

        <div class="{{ $award_notice->status == 0 ? 'pending_banner' : 'approved_banner'}}">
            <p>{{ $award_notice->status == 0 ? 'Pending' : 'Approved'}}</p>
        </div>

        <div class="letter_body">
            <p>Dear Name, {{ $award_notice->proposal->owner->owner_fname . ' ' . $award_notice->proposal->owner->owner_lname }}</p>

            @if($award_notice->status == 0)
                <p>Thank you for registering. We would like to inform you that your Award Notice is currently under review.
                    Our team will notify you once the approval process is complete.</p>

                <p>If you have any questions or require further assistance, feel free to reach out to our support team.</p>

                <p>Thank you for your patience.</p>

                <p>Sincerely,</p>
            @elseif($award_notice->status == 1)
                <p>We are pleased to inform you that your Award Notice has been successfully approved. Congratulations and
                    welcome aboard! Please wait for Commencement Notice to be approved.</p>

                <p>If you have any questions or require assistance, please don't hesitate to reach out to our support team.
                    We are here to help you with anything you need.</p>

                <p>We look forward to your continued engagement with us.</p>

                <p>Sincerely,</p>
            @endif

            <div class="signature">
                <p>Account Name</p>
                <p>Sta. Lucia</p>
            </div>
        </div>

        <div class="letter_footer">
            <p>&copy; 2024 Sta. Lucia. All rights reserved.</p>
        </div>
    </div>
</body>

</html>