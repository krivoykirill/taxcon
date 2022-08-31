<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Odometer;
use App\Rules\StartNotLessThanLastEnd;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data['user'] = $request->user();

        $data['from'] = Carbon::today();
        $data['to'] = Carbon::tomorrow()->toDateString();

        $data['currentRun'] = Odometer::where('user_id', $data['user']->id)->where('odometer_start_date', '>=', $data['from'])->whereNull('odometer_end')->orderBy('created_at')->first();
        $data['todaysRuns'] = Odometer::where('user_id', $data['user']->id)->where('odometer_start_date', '>=', $data['from'])->orderBy('created_at')->get();
        return view('home', $data);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showOdometerForm(Request $request)
    {

        $data['user'] = $request->user();

        $data['from'] = Carbon::today();
        $data['last30'] = Carbon::now()->subDays(30);
        $data['from_yesterday'] = Carbon::yesterday();
        $data['to'] = Carbon::tomorrow()->toDateString();

        $data['currentRun'] = Odometer::where('user_id', $data['user']->id)->where('odometer_start_date', '>=', $data['last30'])->whereNull('odometer_end')->orderBy('created_at')->first();
        $data['todaysRuns'] = Odometer::where('user_id', $data['user']->id)->where('odometer_start_date', '>=', $data['last30'])->orderBy('created_at')->get();
        // dd($data);
        return view('odometer-form', $data);
    }

    public function submitOdometerForm(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'odometer_start' => ['integer', new \App\Rules\StartNotLessThanLastEnd($user)],
            'odometer_end' => ['integer', new \App\Rules\EndNotLesstThanCurrentStart($request->odometer_id), new \App\Rules\StartEndLimits($request->odometer_id)],
        ]);

        $now = Carbon::now();
        $currentRun = (isset($request->odometer_id)) ? Odometer::where('id', $request->odometer_id)->first() : null;

        if ($currentRun && $request->odometer_end) {
            $currentRun->odometer_end = $request->odometer_end;
            $currentRun->odometer_end_date = $now;
            $currentRun->save();
        } else if (!$currentRun && $request->odometer_start && !isset($request->odometer_id)) {
            // dd($request->all());
            $odometer = new Odometer();
            $odometer->odometer_start = $request->odometer_start;
            $odometer->user_id = $request->user()->id;
            $odometer->odometer_start_date = $now;
            $odometer->save();
        }


        return redirect('home');
    }
}
