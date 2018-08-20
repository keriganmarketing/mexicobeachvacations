<?php
$headerImageData = get_field('header_image');

bladerunner('views.pages.weather',[
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline')
]);