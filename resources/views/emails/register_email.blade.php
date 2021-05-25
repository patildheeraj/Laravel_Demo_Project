<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Email</title>
</head>
<body>
    <table>
        <tr>
            <td>Dear {{ $name }} !</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Your account has been created successfully on E-shopper website.<br>Your acoount information is below:</td>
        </tr>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Email:</strong> {{ $email }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Password:</strong> ******** (As chosen by you)</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Thanks & Regards</strong><br>E-shopper website</td>
        </tr>
    </table>
</body>
</html>