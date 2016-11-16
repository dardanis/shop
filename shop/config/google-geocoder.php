<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Geocoder
    |--------------------------------------------------------------------------
    | Geocoding is the process of converting addresses (like "1600 Amphitheatre Parkway, Mountain View, CA")
    | into geographic coordinates (like latitude 37.423021 and longitude -122.083739),
    | which you can use to place markers or position the map.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Application Key
    |--------------------------------------------------------------------------
    |
    | Your application's API key. This key identifies your application for
    | purposes of quota management. Learn how to get a key from the APIs Console.
    */
    'applicationKey' => 'AIzaSyC5vtmCrC0wc3uRAwYpHNfueWPeewN-2WQ',

    /*
    |--------------------------------------------------------------------------
    | Request URL
    |--------------------------------------------------------------------------
    |
    */
    'requestUrl' => [
        'json' => 'https://maps.googleapis.com/maps/api/geocode/json?',
        'xml'  => 'https://maps.googleapis.com/maps/api/geocode/xml?'
    ],
];