@component('mail::message')
# Important

Your Password has been changed!
If you did not change your password Click below to reset


@component('mail::button', ['url' => 'http://127.0.0.1:8000/password/reset'])
Reset Password
@endcomponent

Thanks,<br>
Shiplu
@endcomponent
