<?php
namespace Testing;

use GuzzleHttp\Client;

class FullProperty
{
    public function create()
    {
        $property = new Property
    }

    public function setListingSeo()
    {
        $client = new Client(['base_url' => 'https://rns.mexicobeachvacations.com']);
        $client->get('/search?')
        add_filter('wpseo_title', function () {
            $title = $this->propertyInfo->unit_id . ' ' . $this->properttInfo->unit_name;
            $title = ($this->propertyInfo->unit_num != '' ? $title . ' ' . $this->listingInfo->unit_num : $title);
            $metaTitle = $title . get_bloginfo('name');
            return $metaTitle;
        });

        add_filter('wpseo_metadesc', function () {
            return strip_tags($this->propertyInfo->remarks);
        });

        add_filter('wpseo_opengraph_image', function () {
            return ($this->media['photos'][0]->url != '' ? $this->media['photos'][0]->url : get_template_directory_uri() . '/img/nophoto.jpg');
        });

        add_filter('wpseo_canonical', function () {
            return get_the_permalink() . $this->propertyInfo-> .  '/';
        });

        add_filter('wpseo_opengraph_url', function ($ogUrl) {
            return get_the_permalink() . $this->propertyInfo-> .  +  '/';
        }, 100, 1);
    }
}
