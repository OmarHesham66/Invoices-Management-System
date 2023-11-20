<x-mail::message>
    # Introduction

    The Verification Code is : {{ $code }} , perss the button to visit verfiy page and enter the code .

    <x-mail::button :url="url('/verify')">
        Verify Page
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>