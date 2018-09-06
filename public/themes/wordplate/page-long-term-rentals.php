<?php

use KeriganSolutions\Search\Search;

$units = json_encode(Search::getUnits(['type' => 'Long Term Rental']));
$headerImageData = get_field('header_image');


bladerunner('views.pages.rentals',[
    'checkIn'     => null,
    'checkOut'    => null,
    'location'    => null,
    'units'       => $units,
    'type'        => 'Long Term Rental',
    'headline'    => get_field('headline'),
    'headerImage' => $headerImageData['url']
]);
