<?php

use KeriganSolutions\Search\Search;
use Testing\FullProperty;

// $unit = (isset($_GET['id']) && $_GET['id']!='' ? $_GET['id'] : null );
$headerImageData = get_field('header_image');
$unit = explode('/', $_SERVER['REQUEST_URI']);
// echo '<pre>',print_r($unit),'</pre>';

$fullProperty = new FullProperty();
echo '<pre>', print_r($fullProperty) , '</pre>';


bladerunner('views.pages.property', [
    'unit' => $unit[2],
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline'),
    'fullProperty' => $fullProperty
]);
