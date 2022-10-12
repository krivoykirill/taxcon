<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use App\Models\UserToCar;

class CarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register(Request $request)
    {
        $data['allUsers'] = User::all();
        $data['allUserToCars'] = UserToCar::all();
        $data['allCars'] = Car::all();

        // dd($data);
        return view('car-register', $data);
    }

    public function submitRegister(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'driver_id' => 'required',
            'make' => 'required',
            'model' => 'required',
            'consumption' => 'required|numeric',
            'year' => 'required|integer',
            'license' => 'required',
        ]);

        $car = new Car();
        $car->make = $validated['make'];
        $car->model = $validated['model'];
        $car->consumption = $validated['consumption'];
        $car->year = $validated['year'];
        $car->license_plate = $validated['license'];
        $car->save();
        $car->refresh();
        if (isset($validated['driver_id']) && $validated['driver_id']!='null') {
            $userToCar = new UserToCar();
            $userToCar->user_id = $validated['driver_id'];
            $userToCar->car_id = $car->id;
            $userToCar->save();
        }

        return redirect('show-cars');
    }

    public function showCars(Request $request, $id)
    {

        $data['car'] = Car::where('id', $id)->first();
        if (!$data['car']) {
            return redirect('home');
        }

        $data['userToCar'] = UserToCar::where('car_id', $data['car']->id)->first();
        $data['allUsers'] = User::all();

        // dd($data);
        return view('car-show', $data);
    }

    public function showAllCars(Request $request)
    {

        $data['cars'] = Car::all();

        // dd($data);
        return view('car-show-all', $data);
    }

    public function updateCar(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'driver_id' => 'required',
            'car_id' => 'required|integer',
            'make' => 'required',
            'model' => 'required',
            'consumption' => 'required|numeric',
            'year' => 'required|integer',
            'license' => 'required',
        ]);

        $car = Car::find($validated['car_id']);
        $car->make = $validated['make'];
        $car->model = $validated['model'];
        $car->consumption = $validated['consumption'];
        $car->year = $validated['year'];
        $car->license_plate = $validated['license'];
        $car->save();

        $userToCar = UserToCar::where('car_id', $validated['car_id'])->first();
        if ($userToCar)
        $userToCar->user_id = $validated['driver_id'];
        $userToCar->save();

        return redirect('/show-car/'. $car->id)->with(['updated' => true]);
    }
}
