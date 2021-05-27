<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            <td>Your order status has been updated successfully on E-shopper website.<br><br>Plese check your status on website in my order section.</td>
        </tr>
         <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Order Id:</strong> #{{ $order_id }}</td>
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
            <td><strong>Order Status:</strong>{{ $order_status }}</td>
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
