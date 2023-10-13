@extends('app')
@section('title', __('auth.register'))

@section('content')
  <div class="row">
    <div class="col">
      <h3>Escolha o pais que gostaria de se registrar?</h3>
    </div>
  </div>
  <div class="row justify-content-around">
    @foreach($countries as $key => $country)
      <div class="col-auto">
        <div class="card" style="width: 15rem;">
          <div class="card-body text-center">
            <h1 class="card-title">
              <span class="flag-icon flag-icon-{{ $key }}"></span>
            </h1>
            <h6 class="card-subtitle mb-2 text-muted">
              {{ $country }}
            </h6>
            <a href="{{ route('auth.register.form', ['country' => $key ]) }}" class="card-link">
              Registrar
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection

@section('scripts')
  <script>
  </script>
@endsection
