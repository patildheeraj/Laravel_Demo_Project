<style>
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order #{{ $order->id }}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{ $order->address }} <br>
                        {{ $order->city }} <br>
                        {{ $order->state }} <br>
                        {{ $order->country }} <br>
                        {{ $order->pincode }} <br>
                        {{ $order->mobile }}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{ $order->created_at->format('d-m-Y') }}<br><br>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					{{ $order->payment_method }}<br>
    					{{ $order->user_email }}
    				</address>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Product Code</strong></td>
                                    <td class="text-center"><strong>Product Name</strong></td>
        							<td class="text-center"><strong>Product Unit Price</strong></td>
        							<td class="text-center"><strong>Product Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
                                @php
                                    $sub_total = 0;
                                @endphp
                                @foreach ($order->orders as $item)
                                <tr>
                                    <td>#{{ $item->product_code }}</td>
                                    <td class="text-center">{{ $item->product_name }} Rs.</td>
                                    <td class="text-center">{{ $item->product_price }} Rs.</td>
                                    <td class="text-center">{{ $item->product_qyt }}</td>
                                    <td class="text-right">{{ $item->product_price * $item->product_qyt }} Rs.</td>
                                    @php
                                        $sub_total = $sub_total + $item->product_price * $item->product_qyt;
                                    @endphp
                                </tr>
                            @endforeach
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
                                    <td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">{{ $sub_total }} Rs.</td>
    							</tr>
                                <tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
                                    <td class="no-line"></td>
    								<td class="no-line text-center"><strong>Coupon Discount</strong></td>
    								<td class="no-line text-right">{{ $order->coupon_amount }} Rs.</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
                                    <td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping Charges</strong></td>
    								<td class="no-line text-right">{{ $order->shipping_charges }} Rs.</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
                                    <td class="no-line"></td>
    								<td class="no-line text-center"><strong>Grand Total</strong></td>
    								<td class="no-line text-right">{{ $order->grand_total }} Rs.</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
