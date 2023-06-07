<x-mail::message>
# New Invoice Added
 At {{now ()}}  
Bill Number = {{$name}} <br>
Id = {{$Bill}}

View Invoice and Manage Invoice Details .

<x-mail::button :url='$url' >
Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
