@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-primary mb-5" href="{{url('show-cars')}}">Show All Cars</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ( session()->get('updated') && session()->get('updated') == true)
                    <div class="alert alert-success" role="alert">
                        Record updated
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Update') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('car-update') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="driver"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Driver') }}</label>

                                <div class="col-md-6">
                                    <select name="driver_id" class="form-control">
                                        @if (!isset($userToCar))
                                            <option value="null" selected>Choose driver</option>
                                        @else
                                            <option value="null">Choose driver</option>
                                            @foreach ($allUsers as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $userToCar->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }} {{ $user->surname }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('driver_id')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="make"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Car Brand') }}</label>

                                <div class="col-md-6">
                                    <input placeholder="Ford" id="make" type="text"
                                        class="form-control @error('make') is-invalid @enderror" name="make"
                                        value="{{ $car->make }}" required autocomplete="make" autofocus>

                                    @error('make')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="model"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Model') }}</label>

                                <div class="col-md-6">
                                    <input placeholder="Mondeo" id="model" type="text"
                                        class="form-control @error('model') is-invalid @enderror" name="model"
                                        value="{{ $car->model }}" required autocomplete="model" autofocus>

                                    @error('model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="consumption"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Consumption (L/100km)') }}</label>

                                <div class="col-md-6">
                                    <input placeholder="6.7" step="0.1" id="consumption" type="number"
                                        class="form-control @error('consumption') is-invalid @enderror" name="consumption"
                                        value="{{ $car->consumption }}" required autocomplete="consumption" autofocus>

                                    @error('consumption')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="year"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Year') }}</label>

                                <div class="col-md-6">
                                    <input placeholder="2012" id="year" type="number"
                                        class="form-control @error('year') is-invalid @enderror" name="year"
                                        value="{{ $car->year }}" required autocomplete="year" autofocus>

                                    @error('year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="license"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Reg. Nr.') }}</label>

                                <div class="col-md-6">
                                    <input placeholder="AA-1111" id="license" type="text"
                                        class="form-control @error('license') is-invalid @enderror" name="license"
                                        value="{{ $car->license_plate }}" required autocomplete="license" autofocus>

                                    @error('license')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="car_id" value="{{ $car->id }}">

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="card mt-3">
                    <div class="card-header">
                        All drivers + cars
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <select name="driver_id" class="form-control">
                                    <option value="null" selected>Choose driver</option>
                                    @foreach ($allUsers as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('driver_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <select name="driver_id" class="form-control">
                                    <option value="null" selected>Choose car</option>
                                    @foreach ($allCars as $car)
                                        <option value="{{ $car->id }}">{{ $car->make }}
                                            {{ $car->license_plate }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('driver_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
