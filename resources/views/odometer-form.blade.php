@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Odometra rādījumi') }}</div>

                    <div class="card-body">
                        <form method="post" action="{{ url('submit-odometer-form') }}">
                            <div class="form-group mb-2">
                                <label for="exampleInputEmail1">Odometra starta rādījums</label>
                                <input name="odometer_start" type="number" class="form-control" id="odometerStart"
                                    aria-describedby="emailHelp" placeholder="Ievadiet starta rādījumu"
                                    value="{{ isset($currentRun->odometer_start) ? $currentRun->odometer_start : '' }}"
                                    {{ isset($currentRun->odometer_start) ? 'disabled' : '' }}>
                                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                            </div>
                            <div class="form-group mb-2>
                            <label for="odometerFinish">Odometra finiša rādījums</label>
                                <input name="odometer_end" type="number" class="form-control" id="odometerFinish"
                                    placeholder="Ievadiet finiša rādījumu" {{!isset($currentRun)? 'disabled' : ''}}>
                            </div>
                            <input type="hidden" name="odometer_id"
                                value="{{ isset($currentRun->id) ? $currentRun->id : '' }}">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-2">Saglabāt</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
