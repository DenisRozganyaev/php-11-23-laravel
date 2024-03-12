@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @unless (auth()->user()->telegram_id)
                    <script async src="https://telegram.org/js/telegram-widget.js?22"
                            data-telegram-login="{{env('TELEGRAM_BOT_NAME', '')}}"
                            data-size="large" data-radius="20" data-auth-url="" data-request-access="write"></script>
                @endunless
            </div>
        </div>
    </div>
@endsection
