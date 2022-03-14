@component('mail::message')
    # Hello {{ $user->name }},

    ## We noticed a new sign-in to your account from {{ $location }} {{ $userIp }}

    @component('mail::buttons', [
        'headline' => 'Do you recognize this activity?',
        'buttons' => [
        [
        'url' => '',
        'slot' => 'Yes, it was me',
        ],
        [
        'url' => route('github.logout'),
        'slot' => 'No, secure account',
        ],
        ],
        ])
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
