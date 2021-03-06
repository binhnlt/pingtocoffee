@extends('layouts.skeleton')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="card mb-3">
          <div class="p-4">
            <div class="sidebar-profile" style="border-bottom: 1px dashed #d9d9d9;">
              <div class="header mv3">
                <div class="avatar-container tc">
                  @if ($user->has_avatar)
                    <img class="br-100" src="{{ $user->getAvatarUrl(\App\Helpers\ImageHelper::MEDIUM_SIZE) }}" alt="Avatar" style="width:87px;">
                  @else
                    <div class="br-100 default-avatar" style="background-color: {{ $user->default_avatar_color }}; width: 87px; height: 87px; font-size:25px; padding-top:24px;">
                      {{ $user->getInitials() }}
                    </div>
                  @endif
                </div>
                <h3 class="people-name tc mt-3">{{ $user->getCompleteName() }}</h3>
                <div class="light-gray-text tc mb-3">{{ $user->description }}</div>
                <actions-component :user-id="{{ $user->id }}" :authenticated-user-id="{{ auth()->user()->id }}" :default-type="'{{ $relationship->type }}'"></actions-component>
              </div>
            </div>
            <div>
              <!-- Contact information -->
              <div class="section pt4">
                <div class="f5 mb3">{{ __('user.contact_information_heading') }}</div>
                @include('contacts.partials.phone')
                @include('contacts.partials.email')
                @include('contacts.partials.address')
              </div>

              <!-- Custom information -->
              <div class="section pt4">
                <div class="f5 mb3">{{ __('user.custom_information_heading') }}</div>
                @include('contacts.partials.custom')
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="component-header">
            <div class="mb-3">
              <ul class="relative list ma0 pa0 overflow-hidden">
                <li class="fl">
                  <a href="/contact/{{ $user->id }}?tab=contact-logs" class="db tc pa3 {{ $activeTab == 'contact-logs' ? 'fw6' : '' }}" style="{{ $activeTab == 'contact-logs' ? 'border-bottom: 2px solid #29a8ab; color: #29a8ab;' : 'color: #8c9396;' }} text-decoration: none;">{{ __('user.contact_logs_tab') }}</a>
                </li>
                <li class="fl">
                  <a href="/contact/{{ $user->id }}?tab=reminders" class="db tc pa3 {{ $activeTab == 'reminders' ? 'fw6' : '' }}" style="{{ $activeTab == 'reminders' ? 'border-bottom: 2px solid #29a8ab; color: #29a8ab;' : 'color: #8c9396;' }} text-decoration: none;">{{ __('user.reminders_tab') }}</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="p-3">
            @if($activeTab == 'contact-logs')
              @include('contacts.log.index')
            @endif
            
            @if($activeTab == 'reminders')
              @include('contacts.reminder.index')
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
