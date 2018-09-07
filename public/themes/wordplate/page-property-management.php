<?php

$headerImageData = get_field('header_image');

bladerunner('views.pages.property-management',[
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline')
]);
