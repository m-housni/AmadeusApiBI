<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function index()
    {
        return view('home');
    }

    public function amadeusApiCall($origin, $dest, $departure) {

        require('AmadeusClient.php');
        $amadeus_api = new \AmadeusDahabtours\SelfServiceApiClient(env('AMADEUS_KEY1'),env('AMADEUS_KEY2'));

        //Flights inspiration
        $flight_inspiration = $amadeus_api->flightInspiration([
                                'origin' => $origin
                            ]);
        //Flight Cheapest Date Search
        $flight_dates = $amadeus_api->flightDates([
            'origin'        => $origin,
            'destination'   => $dest,
        ]);

        // Flight Low-fare Search
        $flight_offers = $amadeus_api->lowFares([
            'origin'        => $origin,
            'destination'   => $dest,
            'departureDate' => $departure,
        ]);

        return [
            json_decode($flight_inspiration['response_text']) ?? 'null',
            json_decode($flight_dates['response_text']) ?? 'null',
            json_decode($flight_offers['response_text']) ?? 'null',
        ];
    }
}
