@component('mail::message')
  # Hello!

  You are received this email because your friend is using Ping to coffee to save and find contact information.
  From anywhere, you can connect with your friends and their contact information.
  You won't need to worry about lost phone number, email, or social networks of your friends.

  Interested? **Sign up** for free at below button. We hope you will get more better relationships.

  @component('mail::button', ['url' => env('APP_URL') . '/register?ref=' . $user->referral_code, 'color' => 'blue'])
    Sign Up
  @endcomponent

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
