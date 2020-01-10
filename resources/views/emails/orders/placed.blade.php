@component('mail::message')
Dear {{$name}},

Your Order has been successfully placed with the following detail: <br>
Ticket Id : <b>{{ $Ticket_ID}}</b><br>
Total Order Cost : <b>&#8358;{{$Order_Cost}}</b>

@component('mail::button', ['url' => 'smorfarm.com/#/order/status','color' => 'success'])
Check Your Order Status
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
