@component('mail::message')

Dear {{$full_name}},

Welcome to SmorFarm

We are one of the fastest growing e-commerce and offline market place.
We sell unique and quality farm product with the same price with neighboring state.
You will have the chance to see for yourself that we provide a first-class service.


We will be very happy if you spread the word about SmorFarm in your favourite social network
or just tell your friends about us. <br>
Our Facebook page is <a href="https://facebook.com/smorfarm/">https://facebook.com/smorfarm/</a>, <br>
Twitter Page <a href="https://twitter.com/smorfarm/">https://twitter.com/smorfarm/</a>,<br>
Instagram Page <a href="https://instagram.com/smorfarm/">https://instagram.com/smorfarm/</a>. <br>
This way,you will help our mission of making SmorFarm world best market place,
24/7 Customer Support Service avaliable to as many people as possible.

Your staff account username is: {{$username}}, <br>
Your staff  account password : {{$password}}

@component('mail::button', ['url' => 'smorfarm.com/staff/login','color' => 'success'])
Access Account Now
@endcomponent

Best Regards,<br>
{{ config('app.name') }} Team
@endcomponent
