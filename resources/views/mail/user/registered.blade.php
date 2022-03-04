@component('mail::message')
    # Hello {{$user}},

    Welcome to our awesome application. Be free to explore.

    @component('mail::button', ['url' => '/'])
        Explore
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
