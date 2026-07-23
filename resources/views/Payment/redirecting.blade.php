@extends('layouts.app')

@section('title', 'Redirecting to Payment')

@section('content')
<section class="min-h-[60vh] flex flex-col items-center justify-center gap-4 px-4 text-center">
    <div class="w-12 h-12 border-4 border-green-600 border-t-transparent rounded-full animate-spin"></div>
    <p class="text-stone-600">Redirecting you to the payment gateway, please wait...</p>

    <form action="{{ $gatewayUrl }}" method="POST" id="gateway-form">
        @foreach ($fields as $name => $value)
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        @endforeach
    </form>
</section>

<script>
    document.getElementById('gateway-form').submit();
</script>
@endsection