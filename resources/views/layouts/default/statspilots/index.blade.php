@extends('app')
@section('title', 'Estadisticas Pilotos')
@php
  $pilotsrankflights = file_get_contents('https://dov.eagleair.com.br/statsapi/index.php?10voos');
  $pilotsrankflightsjson = json_decode($pilotsrankflights);
  $pilotsrankhours = file_get_contents('https://dov.eagleair.com.br/statsapi/index.php?10horas');
  $pilotsrankhoursjson = json_decode($pilotsrankhours);
  $pilotsrankflightslast = file_get_contents('https://dov.eagleair.com.br/statsapi/index.php?10vooslast');
  $pilotsrankflightslastjson = json_decode($pilotsrankflightslast);
  $pilotsrankhourslast = file_get_contents('https://dov.eagleair.com.br/statsapi/index.php?10horaslast');
  $pilotsrankhourslastjson = json_decode($pilotsrankhourslast);
  $landingrate = file_get_contents('https://dov.eagleair.com.br/statsapi/index.php?10landing');
  $landingratejson = json_decode($landingrate);
@endphp
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@section('content')
  <div class="row">
    <div class="col-md-12">
      <h2>Estadísticas Pilotos</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h3><b>Média de Pouso</b></h3>
    </div>
    <div class="col-sm-12">
      <div class="card">
        <div class="nav nav-tabs" role="tablist" style="background: #067ec1; color: #FFF;">
          Média de Pouso
        </div>
        <div class="card-body">
          <!-- Tab panes -->
          <div class="tab-content table-responsive">
            <table class="table table-hover" id="users-table">
              <thead>
                <th>Posição</th>
                <th></th>
                <th>Piloto</th>
                <th>Voo</th>
                <th style="text-align: center">Toque</th>
              </thead>
              <tbody>
              @foreach($landingratejson as $pilot)
                <tr>
                @if($loop->iteration == 1)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: gold;"></i></td>
                @elseif($loop->iteration == 2)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: silver;"></i></td>
                @elseif($loop->iteration == 3)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: darkgoldenrod;"></i></td>
                @else
                  <td align="left"><b>{{$loop->iteration}}º </b></td>
                @endif
                  <td style="width: 80px;">
                    <div class="photo-container">
                      @if ($pilot->avatar == null)
                        <img class="rounded-circle" src="https://en.gravatar.com/userimage/12856995/aa6c0527a723abfd5fb9e246f0ff8af4.png"/>
                      @else
                        <img src="http://dov.eagleair.com.br/uploads/{{ $pilot->avatar }}">
                      @endif
                    </div>
                  </td>
                  <td>
                    <a href="{{ route('frontend.users.show.public', [$pilot->user_id]) }}" target="_blank">
                      EAG{{$pilot->pilot_id}}&nbsp;{{ $pilot->name }}
                    </a>
                    @if(filled($pilot->country))
                      <span class="flag-icon flag-icon-{{ $pilot->country }}"></span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('frontend.pireps.show', [$pilot->id]) }}" target="_blank">
                      EAG{{$pilot->flight_number}} ({{$pilot->dpt_airport_id}}-{{$pilot->arr_airport_id}})
                    </a>
                  </td>
                  <td align="center">{{$pilot->landing_rate}} fpm</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <br>
      <hr>
      <h3><b>Mês Atual</b></h3>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="nav nav-tabs" role="tablist" style="background: #067ec1; color: #FFF;">
          Voos
        </div>
        <div class="card-body">
          <!-- Tab panes -->
          <div class="tab-content table-responsive">
            <table class="table table-hover" id="users-table">
              <thead>
                <th>Posição</th>
                <th></th>
                <th>Piloto</th>
                <th style="text-align: center">Voos</th>
              </thead>
              <tbody>
              @foreach($pilotsrankflightsjson as $pilot)
                <tr>
                @if($loop->iteration == 1)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: gold;"></i></td>
                @elseif($loop->iteration == 2)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: silver;"></i></td>
                @elseif($loop->iteration == 3)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: darkgoldenrod;"></i></td>
                @else
                  <td align="left"><b>{{$loop->iteration}}º </b></td>
                @endif
                  <td style="width: 80px;">
                    <div class="photo-container">
                      @if ($pilot->avatar == null)
                        <img class="rounded-circle" src="https://en.gravatar.com/userimage/12856995/aa6c0527a723abfd5fb9e246f0ff8af4.png"/>
                      @else
                        <img src="http://dov.eagleair.com.br/uploads/{{ $pilot->avatar }}">
                      @endif
                    </div>
                  </td>
                  <td>
                    <a href="{{ route('frontend.users.show.public', [$pilot->user_id]) }}" target="_blank">
                      EAG{{$pilot->pilot_id}}&nbsp;{{ $pilot->name }}
                    </a>
                    @if(filled($pilot->country))
                      <span class="flag-icon flag-icon-{{ $pilot->country }}"></span>
                    @endif
                  </td>
                  <td align="center">{{$pilot->voos}}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="nav nav-tabs" role="tablist" style="background: #067ec1; color: #FFF;">
          Horas
        </div>
        <div class="card-body">
          <!-- Tab panes -->
          <div class="tab-content table-responsive">
            <table class="table table-hover" id="users-table">
              <thead>
                <th>Posição</th>
                <th></th>
                <th>Piloto</th>
                <th style="text-align: center">Horas</th>
              </thead>
              <tbody>
              @foreach($pilotsrankhoursjson as $pilot)
                <tr>
                @if($loop->iteration == 1)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: gold;"></i></td>
                @elseif($loop->iteration == 2)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: silver;"></i></td>
                @elseif($loop->iteration == 3)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: darkgoldenrod;"></i></td>
                @else
                  <td align="left"><b>{{$loop->iteration}}º </b></td>
                @endif
                  <td style="width: 80px;">
                    <div class="photo-container">
                      @if ($pilot->avatar == null)
                        <img class="rounded-circle" src="https://en.gravatar.com/userimage/12856995/aa6c0527a723abfd5fb9e246f0ff8af4.png"/>
                      @else
                        <img src="http://dov.eagleair.com.br/uploads/{{ $pilot->avatar }}">
                      @endif
                    </div>
                  </td>
                  <td>
                    <a href="{{ route('frontend.users.show.public', [$pilot->user_id]) }}" target="_blank">
                      EAG{{$pilot->pilot_id}}&nbsp;{{ $pilot->name }}
                    </a>
                    @if(filled($pilot->country))
                      <span class="flag-icon flag-icon-{{ $pilot->country }}"></span>
                    @endif
                  </td>
                  <td align="center">@minutestotime($pilot->horas)</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <br>
      <hr>
      <h3><b>Mês Anterior</b></h3>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="nav nav-tabs" role="tablist" style="background: #067ec1; color: #FFF;">
          Voos
        </div>
        <div class="card-body">
          <!-- Tab panes -->
          <div class="tab-content table-responsive">
            <table class="table table-hover" id="users-table">
              <thead>
                <th>Posição</th>
                <th></th>
                <th>Piloto</th>
                <th style="text-align: center">Voos</th>
              </thead>
              <tbody>
              @foreach($pilotsrankflightslastjson as $pilot)
                <tr>
                @if($loop->iteration == 1)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: gold;"></i></td>
                @elseif($loop->iteration == 2)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: silver;"></i></td>
                @elseif($loop->iteration == 3)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: darkgoldenrod;"></i></td>
                @else
                  <td align="left"><b>{{$loop->iteration}}º </b></td>
                @endif
                  <td style="width: 80px;">
                    <div class="photo-container">
                      @if ($pilot->avatar == null)
                        <img class="rounded-circle" src="https://en.gravatar.com/userimage/12856995/aa6c0527a723abfd5fb9e246f0ff8af4.png"/>
                      @else
                        <img src="http://dov.eagleair.com.br/uploads/{{ $pilot->avatar }}">
                      @endif
                    </div>
                  </td>
                  <td>
                    <a href="{{ route('frontend.users.show.public', [$pilot->user_id]) }}" target="_blank">
                      EAG{{$pilot->pilot_id}}&nbsp;{{ $pilot->name }}
                    </a>
                    @if(filled($pilot->country))
                      <span class="flag-icon flag-icon-{{ $pilot->country }}"></span>
                    @endif
                  </td>
                  <td align="center">{{$pilot->voos}}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="nav nav-tabs" role="tablist" style="background: #067ec1; color: #FFF;">
          Horas
        </div>
        <div class="card-body">
          <!-- Tab panes -->
          <div class="tab-content table-responsive">
            <table class="table table-hover" id="users-table">
              <thead>
              <th>Posição</th>
              <th></th>
              <th>Piloto</th>
              <th style="text-align: center">Horas</th>
              </thead>
              <tbody>
              @foreach($pilotsrankhourslastjson as $pilot)
                <tr>
                @if($loop->iteration == 1)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: gold;"></i></td>
                @elseif($loop->iteration == 2)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: silver;"></i></td>
                @elseif($loop->iteration == 3)
                  <td align="left"><b>{{$loop->iteration}}º </b><i class="fa fa-trophy" style="color: darkgoldenrod;"></i></td>
                @else
                  <td align="left"><b>{{$loop->iteration}}º </b></td>
                @endif
                  <td style="width: 80px;">
                    <div class="photo-container">
                      @if ($pilot->avatar == null)
                        <img class="rounded-circle" src="https://en.gravatar.com/userimage/12856995/aa6c0527a723abfd5fb9e246f0ff8af4.png"/>
                      @else
                        <img src="http://dov.eagleair.com.br/uploads/{{ $pilot->avatar }}">
                      @endif
                    </div>
                  </td>
                  <td>
                    <a href="{{ route('frontend.users.show.public', [$pilot->user_id]) }}" target="_blank">
                      EAG{{$pilot->pilot_id}}&nbsp;{{ $pilot->name }}
                    </a>
                    @if(filled($pilot->country))
                      <span class="flag-icon flag-icon-{{ $pilot->country }}"></span>
                    @endif
                  </td>
                  <td align="center">@minutestotime($pilot->horas)</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
