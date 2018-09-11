<?php
$headerImageData = get_field('header_image');

bladerunner('views.pages.about-us',[
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline'),
    'featureBox1' => [
        'title' => get_field('feat_1_headline', get_option('page_on_front')),
        'text' => get_field('feat_1_text', get_option('page_on_front')),
        'link' => get_field('feat_1_link', get_option('page_on_front'))
    ],
    'featureBox2' => [
        'title' => get_field('feat_2_headline', get_option('page_on_front')),
        'text' => get_field('feat_2_text', get_option('page_on_front')),
        'link' => get_field('feat_2_link', get_option('page_on_front'))
    ],
    'featureBox3' => [
        'title' => get_field('feat_3_headline', get_option('page_on_front')),
        'text' => get_field('feat_3_text', get_option('page_on_front')),
        'link' => get_field('feat_3_link', get_option('page_on_front'))
    ]
]);