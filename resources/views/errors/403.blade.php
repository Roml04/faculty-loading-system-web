@php
    $pagetitle = "Access Denied";
    $errortitle = "403 - Access Denied";
    $errormessage = "You do not have access to this resource.";
@endphp

<x-layout :pagetitle="$pagetitle">
    <x-error-layout :errortitle="$errortitle" :errormessage="$errormessage"/>
</x-layout>
