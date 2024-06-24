<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>

    <p>Hello {{ $user->name }},</p>
    
    <p>Your order with order number {{ $order->order_no }} has been confirmed. Below are the order details:</p>
    
    <ul>
        @foreach ($orderItems as $item)
            <li>{{ $item->product->title }} ({{ $item->quantity }}) - {{ $currencySymbol }}{{ number_format($item->total_price * $exchangeRate, 2) }}</li>
        @endforeach
    </ul>
    
    <p>Total Amount: {{ $currencySymbol }}{{ number_format($order->total_amount * $exchangeRate, 2) }}</p>
    
    <p>Thank you for your purchase!</p>
</body>
</html>
