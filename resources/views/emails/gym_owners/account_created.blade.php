<x-mail::message>
# Introduction

Your Account Has Been Created. <br>
Email : {{$user->email}} <br>
Password : 12345678<br>
Please Change Ur Password into somehing u Preffer Asap


<x-mail::button :url="'http://127.0.0.1:8000/'">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
