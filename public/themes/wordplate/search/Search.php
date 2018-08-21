<?php

namespace KeriganSolutions\Search;

use Carbon\Carbon;
use GuzzleHttp\Client;

class Search {

    public static function getUnits($request)
    {
        $checkIn     = $request['checkIn'] ?? Carbon::now()->toDateString();
        $checkOut    = $request['checkOut'] ?? null;
        $location    = $request['location'] ?? null;
        $type        = $request['type'] ?? null;

        $client = new Client();

        $response = $client->request('GET', 'https://rns.mexicobeachvacations.com/search', [
            'query' => [
                'checkIn'  => $checkIn,
                'checkOut' => $checkOut,
                'location' => $location,
                'type'     => $type
            ]
        ]);

        $units = json_decode($response->getBody());

        return $units;
    }
}
