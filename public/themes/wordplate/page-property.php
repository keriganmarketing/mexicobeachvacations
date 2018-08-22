<?php

use KeriganSolutions\Search\Search;

$unit = (isset($_GET['id']) && $_GET['id']!='' ? $_GET['id'] : null );
$headerImageData = get_field('header_image');

bladerunner('views.pages.property',[
    'unit' => $unit,
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline')
]);
