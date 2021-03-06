<?php

use KeriganSolutions\KMATestimonials\Testimonial;
$testimonials = new Testimonial;
$featuredTestimonial = $testimonials->queryTestimonials(true, 1, 'date', 'DESC', 115);

bladerunner('views.pages.front', [
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
    'featuredTestimonial' => $featuredTestimonial,
    'headline'    => get_field('headline'),
    'featuredImage' => get_field('content_image')
]);