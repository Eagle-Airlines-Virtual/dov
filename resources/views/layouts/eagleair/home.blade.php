@extends('app')
@section('title', __('home.welcome.title'))

@section('content')
  <div class="row">
    <div class="col-sm-12">
      <h2 class="description">@lang('common.stats')</h2>
        <div class="col-sm-2 card blue-bg">
          <div class="header header-primary text-center blue-bg">
            <h3 class="title title-up text-white">
              <a class="text-white">Voos</a>
            </h3>
          </div>
          <div class="content content-center">
            <div class="social-description text-center text-white">
              <h2 class="description text-white">
{{--              {{ file_get_contents('https://dov.eagleair.com.br/statsapi/index.php?voos'); }}--}}
              </h2>
            </div>
          </div>
        </div>
        <div class="col-sm-3 card blue-bg">
          <div class="header header-primary text-center blue-bg">
            <h3 class="title title-up text-white">
              <a class="text-white">Horas</a>
            </h3>
          </div>
          <div class="content content-center">
            <div class="social-description text-center text-white">
              <h2 class="description text-white">
{{--              {{ file_get_contents('https://dov.eagleair.com.br/statsapi/index.php?horas'); }}--}}
              </h2>
            </div>
          </div>
        </div>
        <div class="col-sm-3 card blue-bg">
          <div class="header header-primary text-center blue-bg">
            <h3 class="title title-up text-white">
              <a class="text-white">Milhas</a>
            </h3>
          </div>
          <div class="content content-center">
            <div class="social-description text-center text-white">
              <h2 class="description text-white">
{{--              {{ file_get_contents('https://dov.eagleair.com.br/statsapi/index.php?milhas'); }} nm--}}
              </h2>
            </div>
          </div>
        </div>
        <div class="col-sm-3 card blue-bg">
          <div class="header header-primary text-center blue-bg">
            <h3 class="title title-up text-white">
              <a class="text-white">Média Pouso</a>
            </h3>
          </div>
          <div class="content content-center">
            <div class="social-description text-center text-white">
              <h2 class="description text-white">
{{--              {{ file_get_contents('https://dov.eagleair.com.br/statsapi/index.php?td'); }} fpm--}}
              </h2>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <h2 class="description">@lang('common.newestpilots')</h2>
      @foreach($users as $user)
        <div class="card card-signup blue-bg">
          <div class="header header-primary text-center blue-bg">
            <h3 class="title title-up text-white">
              <a href="{{ route('frontend.profile.show', [$user->id]) }}" class="text-white">{{ $user->name_private }}</a>
            </h3>
            <div class="photo-container">
              @if ($user->avatar == null)
                <img class="rounded-circle"
                     src="{{ $user->gravatar(123) }}">
              @else
                <img src="{{ $user->avatar->url }}" style="width: 123px;">
              @endif
            </div>
          </div>
          <div class="content content-center">
            <div class="social-description text-center text-white">
              <h2 class="description text-white">
                @if(filled($user->home_airport))
                  {{ $user->home_airport->icao }}
                @endif
              </h2>
            </div>
          </div>
          <div class="footer text-center">
            <a href="{{ route('frontend.profile.show', [$user->id]) }}"
               class="btn btn-neutral btn-sm">@lang('common.profile')</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
