@component('mail::message')
Dear {{$name}},

Your Pre Order has been successfully placed with the following detail: <br>

Ticket Id : <b>{{ $Ticket_ID}}</b><br>
Total Order Cost : <b>&#8358;{{$Order_Cost}}</b> <br>
Date To Deliver : <b>{{ $date_to}}</b> <br>
Time To Deliver : <b>{{ $time_to}}</b>

@component('mail::button', ['url' => 'smorfarm.com/#/order/status','color' => 'success'])
Check Your Pre Order Status
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
