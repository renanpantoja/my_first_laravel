<x-emails.layout>

<p>Hello {{ $user->name }},</p>

<p>You are receiving this email because we received a password reset request for your account.</p>

<div style="text-align:center; margin: 20px 0;">
    <a href="{{ $url }}" style="background-color:#3490dc; color:#fff; padding:10px 20px; text-decoration:none; border-radius:4px;">
        Reset Password
    </a>
</div>

<p>If you did not request a password reset, no further action is required.</p>

<p>Thanks,<br>{{ config('app.name') }}</p>

</x-emails.layout>
    