@php
    $pagetitle = "Internal Server Error";
    $errortitle = "500 - Internal Server Error";
    $errormessage = "The server encountered an internal error. Please refresh the page or return later once the issue has been resolved.";
@endphp

<x-layout :pagetitle="$pagetitle">
    <x-error-layout :errortitle="$errortitle" :errormessage="$errormessage"/>
</x-layout>
