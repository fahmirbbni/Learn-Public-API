<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\City;
use App\Models\Province;
use App\Models\Courier;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class HomeController extends Controller
{
    public function index()
    {
        $couriers = Courier::pluck('title', 'code');
        $provinces = Province::pluck('title', 'province_id');
        return view('welcome', compact('couriers', 'provinces'));
    }

    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('title', 'city_id');
        return json_encode($city);
    }

    public function submit(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin' => $request->city_origin,
            'destination' => $request->city_destination,
            'weight' => $request->weight,
            'courier' => $request->courier,
        ])->get();

        dd($cost);
    }
}
