<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Email</title>
</head>
<body>
    <table>
        <tr>
            <td>Dear {{ $name }},</td>
        </tr>
        <tr>
            <td>You have required to recover your password. New Password is given below:</td>
        </tr>
        <tr>
            <td>Name: {{ $name }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>New Password:<strong> {{ $password }}</strong></td>
        </tr>
    </table>
</body>
</html>