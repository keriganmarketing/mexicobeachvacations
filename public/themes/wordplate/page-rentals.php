<?php

use KeriganSolutions\Search\Search;

$units = Search::getUnits($_GET);
$headerImageData = get_field('header_image');

bladerunner('views.pages.rentals',[
    'units' => $units,
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline')
]);
