@php
    $pagetitle = "Internal Server Error";
    $errortitle = "500 - Internal Server Error";
    $errormessage = "Something went wrong on our end. Please try again later.";
@endphp

<x-layout :pagetitle="$pagetitle">
    <x-error-layout :errortitle="$errortitle" :errormessage="$errormessage"/>
</x-layout>
