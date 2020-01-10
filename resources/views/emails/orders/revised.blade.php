@component('mail::message')
Dear {{$name}},

We are so sorry to inform you that your order with the following detail:
 <br>

Ticket Id : <b>{{ $Ticket_ID}}</b><br>
Total Order Cost : <b>&#8358;{{$Order_Cost}}</b>

has been Revised from it order delivery status,
 your order is on the way kindly wait shortly

@component('mail::button', ['url' => 'smorfarm.com/#/order/status','color' => 'success'])
Check Your Order Status Here 
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
