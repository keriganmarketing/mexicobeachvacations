<?php

use KeriganSolutions\Search\Search;

$units = json_encode(Search::getUnits($_GET));
$checkIn = isset($_GET['checkIn']) && $_GET['checkIn'] !== '' ? json_encode($_GET['checkIn']) : null;
$checkOut = isset($_GET['checkOut']) && $_GET['checkOut'] !== '' ? json_encode($_GET['checkOut']) : null;
$location = isset($_GET['location']) && $_GET['location'] !== '' ? json_encode($_GET['location']) : null;
$type = isset($_GET['type']) && $_GET['type'] !== '' ? json_encode($_GET['type']) : null;
$headerImageData = get_field('header_image');

bladerunner('views.pages.rentals',[
    'units'       => $units,
    'checkIn'     => $checkIn,
    'checkOut'    => $checkOut,
    'location'    => $location,
    'type'        => $type,
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline')
]);
