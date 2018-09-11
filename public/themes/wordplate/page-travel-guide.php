<?php
$headerImageData = get_field('header_image');

bladerunner('views.pages.travel-guide',[
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline'),
    'featureBox1' => [
        'title' => get_field('feat_1_headline'),
        'text' => get_field('feat_1_text'),
        'link' => get_field('feat_1_link')
    ],
    'featureBox2' => [
        'title' => get_field('feat_2_headline'),
        'text' => get_field('feat_2_text'),
        'link' => get_field('feat_2_link')
    ],
    'featureBox3' => [
        'title' => get_field('feat_3_headline'),
        'text' => get_field('feat_3_text'),
        'link' => get_field('feat_3_link')
    ],
    'featureBox4' => [
        'title' => get_field('feat_4_headline'),
        'text' => get_field('feat_4_text'),
        'link' => get_field('feat_4_link')
    ],
    'featureBox5' => [
        'title' => get_field('feat_5_headline'),
        'text' => get_field('feat_5_text'),
        'link' => get_field('feat_5_link')
    ],
]);