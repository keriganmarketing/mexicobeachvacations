<?php

use KeriganSolutions\Search\Search;
use Testing\FullProperty;

$headerImageData = get_field('header_image');
$fullProperty = new FullProperty();

bladerunner('views.pages.property', [
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline'),
    'fullProperty' => $fullProperty->getProperty()
]);
