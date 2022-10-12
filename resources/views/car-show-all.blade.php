@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{url('register-car')}}" class="btn btn-primary mb-5">Add New Car</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(isset($cars) && count($cars)>0)
                <table class="table">
                    <thead class="text-center">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Make</th>
                        <th scope="col">Model</th>
                        <th scope="col">License Plate</th>
                        <th scope="col">Consumption</th>
                        <th scope="col">Year</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                            
                        @foreach($cars as $car)
                        <tr class="text-center">
                            <td>{{$car->id}}</td>
                            <td>{{$car->make}}</td>
                            <td>{{$car->model}}</td>
                            <td>{{$car->license_plate}}</td>
                            <td>{{$car->consumption}}</td>
                            <td>{{$car->year}}</td>
                            <td><a href="{{url('show-car/'.$car->id)}}" class="btn btn-secondary">Edit</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="mt-5">No cars Found</p>
                @endif
            </div>
        </div>
    </div>
@endsection
