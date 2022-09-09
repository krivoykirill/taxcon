@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Laipni lūdzam, ' . Auth::user()->name. '!') }}</div>

                    <div class="card-body d-flex">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (!$currentRun)
                            <a class="text-center font-weight-bold btn btn-success my-3 mx-auto"
                                href="{{ url('show-odometer-form') }}">Sākt darbu</a>
                        @else
                            <a class="text-center font-weight-bold btn btn-danger my-3 mx-auto"
                                href="{{ url('show-odometer-form') }}">Beigt darbu</a>
                        @endif
                    </div>
                </div>
                @if ($todaysRuns)
                    <div class="card mt-3">
                        <div class="card-header">{{ __('Jūsu mēneša rādījumi') }}</div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Starts</th>
                                        <th scope="col">Finišs</th>
                                        <th scope="col">KM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todaysRuns as $index => $run)
                                        <tr>
                                            <th scope="row">{{$index+1}}</th>
                                            <td>{{$run->odometer_start}}</td>
                                            <td>{{$run->odometer_end}}</td>
                                            <td>{!! (($run->odometer_end - $run->odometer_start)>0)? $run->odometer_end - $run->odometer_start : '<span class="font-weight-bold text-danger">Atvērts darbs</span>'!!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
