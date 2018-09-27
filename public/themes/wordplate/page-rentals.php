<?php

use KeriganSolutions\Search\Search;

$units = json_encode(Search::getUnits($_GET));
$checkIn = isset($_GET['checkIn']) && $_GET['checkIn'] !== '' ? $_GET['checkIn'] : null;
$checkOut = isset($_GET['checkOut']) && $_GET['checkOut'] !== '' ? $_GET['checkOut'] : null;
$location = isset($_GET['location']) && $_GET['location'] !== '' ? $_GET['location'] : null;
$type = isset($_GET['type']) && $_GET['type'] !== '' ? $_GET['type'] : null;
$pool = isset($_GET['pool']) && $_GET['pool'] !== '' ? $_GET['pool'] : null;
$name = isset($_GET['property-name']) && $_GET['property-name'] !== '' ? $_GET['property-name'] : null;
$headerImageData = get_field('header_image');

bladerunner('views.pages.rentals',[
    'units'       => $units,
    'checkIn'     => $checkIn,
    'checkOut'    => $checkOut,
    'location'    => $location,
    'type'        => $type,
    'pool'        => $pool,
    'name'        => $name,
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline')
]);
