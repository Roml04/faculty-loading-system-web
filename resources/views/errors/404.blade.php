@php
    $pagetitle = "Page Not Found";
    $errortitle = "404 - PAGE NOT FOUND";
    $errormessage = "The page you're looking for doesn't exist or may have been moved. Please check the URL or return to the home page.";
@endphp

<x-layout :pagetitle="$pagetitle">
    <x-error-layout :errortitle="$errortitle" :errormessage="$errormessage"/>
</x-layout>
