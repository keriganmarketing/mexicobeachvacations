<?php

namespace KeriganSolutions\Search;

use Carbon\Carbon;
use GuzzleHttp\Client;

class Search {

    public static function getUnits($request)
    {
        $checkIn     = $request['checkIn'] ?? null;
        $checkOut    = $request['checkOut'] ?? null;
        $location    = $request['location'] ?? null;
        $type        = $request['type'] ?? null;
        $pool        = $request['pool'] ?? null;

        $client = new Client();

        $response = $client->request('GET', 'https://rns.mexicobeachvacations.com/search', [
            'query' => [
                'checkIn'  => $checkIn,
                'checkOut' => $checkOut,
                'location' => $location,
                'type'     => $type,
                'pool'     => $pool
            ]
        ]);

        $units = json_decode($response->getBody());

        return $units;
    }
}
