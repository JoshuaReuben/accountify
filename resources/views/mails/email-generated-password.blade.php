<x-mail::message>
    # Your account has been successfully created!

    Welcome to {{ config('app.name') }}. Below is your temporary password. Please use it to log in to your account:

    Temporary Password: {{ $password }}

    For security reasons, we recommend changing your password after logging in.

    Thank you,
    The {{ config('app.name') }} Team
</x-mail::message>
