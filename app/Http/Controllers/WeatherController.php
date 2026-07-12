<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $city = $request->city ?? 'Pekanbaru';

        $weather = null;
        $error = null;

        try {

            // Cari koordinat kota
            $geo = Http::get(
                'https://geocoding-api.open-meteo.com/v1/search',
                [
                    'name' => $city,
                    'count' => 1,
                    'language' => 'id',
                    'format' => 'json'
                ]
            )->json();

            if (!isset($geo['results'][0])) {

                $error = "Kota tidak ditemukan.";

                return view(
                    'weather',
                    compact('weather','city','error')
                );
            }

            $latitude = $geo['results'][0]['latitude'];
            $longitude = $geo['results'][0]['longitude'];

            // Ambil cuaca
            $weatherResponse = Http::get(
                'https://api.open-meteo.com/v1/forecast',
                [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'current_weather' => true
                ]
            );

            $weather = $weatherResponse->json();

            $weather['city_name'] = $geo['results'][0]['name'];
            $weather['country'] = $geo['results'][0]['country'];

        } catch (\Exception $e) {

            $error = $e->getMessage();
        }

        return view(
            'weather',
            compact('weather','city','error')
        );
    }
}