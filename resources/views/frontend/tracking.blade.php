@if ($tracking)
    <p>Order Status: {{ $tracking->status }}</p>
    <p>Tracking Number: {{ $tracking->tracking_number }}</p>
    <p>Delivery Partner: {{ $tracking->delivery_partner }}</p>
@else
    <p>Tracking information is not available at the moment.</p>
@endif
