@component('mail::message')
Dear {{$name}},

Your Order  with the following detail: 
<br>

Ticket Id : <b>{{ $Ticket_ID}}</b><br>
Total Order Cost : <b>&#8358;{{$Order_Cost}}</b>
<br>

has been successfully delivered

@component('mail::button', ['url' => 'smorfarm.com','color' => 'success'])
Order More Items From SmorFarm
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
