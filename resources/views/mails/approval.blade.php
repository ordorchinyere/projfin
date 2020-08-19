@component('mail::message')
Hello **{{$name}}**,

Your project has been approved.

Click below to view your project status
@component('mail::button', ['url' => $link])
View project
@endcomponent
Sincerely,  
Projfin.
@endcomponent