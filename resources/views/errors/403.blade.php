@php
    $pagetitle = "Access Denied";
    $errortitle = "403 - Access Denied";
    $errormessage = "Access to this resource is restricted. Your account does not have the necessary permissions to view or perform this action.";
@endphp

<x-layout :pagetitle="$pagetitle">
    <x-error-layout :errortitle="$errortitle" :errormessage="$errormessage"/>
</x-layout>
