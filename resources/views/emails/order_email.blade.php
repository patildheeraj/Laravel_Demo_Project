<html>
<html lang="en">
<head>
    <title>Order Email</title>
</head>
<body>
    <table width="700px">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Hello {{ $name }} !</td>
        </tr>
        <tr>
            <td>Thank you for shopping with us. Your order details are as given below:</td>
        </tr>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Order Number:</strong> {{ $order_id }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width="95%" cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
                    <tr bgcolor="#cccccc">
                        <td>Product Name</td>
                        <td>Product Code</td>
                        <td>Unit Price</td>
                        <td>Quantity</td>
                    </tr>
                    @foreach ($productDetails['orders'] as $item)
                        <tr>
                            <td>{{ $item['product_name'] }}</td>
                            <td>#{{ $item['product_code'] }}</td>
                            <td>{{ $item['product_price'] }} Rs.</td>
                            <td>{{ $item['product_qyt'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" align="right">Coupon Code</td>
                        <td>{{ $productDetails['coupon_code'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">Coupon Amount</td>
                        <td>{{ $productDetails['coupon_amount'] }} Rs.</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">Shipping Charges</td>
                        <td>{{ $productDetails['shipping_charges'] }} Rs.</td>
                    </tr>
                    <tr bgcolor="#cccccc">
                        <td colspan="3" align="right"><strong>Grand Total</strong></td>
                        <td><strong>{{ $productDetails['grand_total'] }} Rs.</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width=100%>
                    <tr>
                        <td width="50%">
                            <table>
                                <tr>
                                    <td><strong>Bill To</strong></td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['address'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['city'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['state'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['country'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['pincode'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $userDetails['mobile'] }}</td>
                                </tr>
                            </table>
                        </td>
                        <td width=50%>
                             <table>
                                <tr>
                                    <td><strong>Ship To</strong></td>
                                </tr>
                                <tr>
                                    <td>{{ $shippingAddress['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $shippingAddress['address'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $shippingAddress['city'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $shippingAddress['state'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $shippingAddress['country'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $shippingAddress['pincode'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $shippingAddress['mobile'] }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>For any enquiries, you can contact us at <a href="#">info@eshopper.com</a></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Thanks & Regards</strong><br>Team E-shopper <br>
                <img src="{{ asset('frontend\logo.png') }}"/>
            </td>
        </tr>
    </table>
</body>
</html>