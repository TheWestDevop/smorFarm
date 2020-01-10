@component('mail::message')
Dear {{$name}},

Your Pre Order  with the following detail: 
<br>

Ticket Id : <b>{{ $Ticket_ID}}</b><br>
Total Pre Order Cost : <b>&#8358;{{$Order_Cost}}</b><br>
Date To Deliver : <b>{{ $date_to}}</b> <br>
Time To Deliver : <b>{{ $time_to}}</b>


has been successfully delivered

@component('mail::button', ['url' => 'smorfarm.com','color' => 'success'])
Pre Order More Items from SmorFarm
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent