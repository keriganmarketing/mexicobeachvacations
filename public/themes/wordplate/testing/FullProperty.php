<?php
namespace Testing;

use GuzzleHttp\Client;

class FullProperty
{
    protected $rns_id;
    protected $property;

    public function __construct($rns_id='')
    {
        if ($rns_id=='') {
            $this->getRnsId();
        } else {
            $this->rns_id = $rns_id;
        }
        $this->create();
        $this->setPropertySeo();
    }

    public function getProperty()
    {
        return $this->property;
    }

    public function getRnsId()
    {
        $pathFragments = explode('property/', $_SERVER['REQUEST_URI']);
        $this->rns_id = str_replace('/', '', end($pathFragments));
    }

    public function create()
    {
        $client = new Client(['base_uri' => 'https://rns.mexicobeachvacations.com/']);
        $apiCall = $client->request(
            'GET',
            'units/' . $this->rns_id
        );

        $results = json_decode($apiCall->getBody());
        $this->property = $results;
    }
    public function setPropertySeo()
    {
        add_filter('wpseo_title', function () {
            $title = $this->property->name;
            $metaTitle = $title . ' | ' . get_bloginfo('name');
            return $metaTitle;
        });

        add_filter('wpseo_metadesc', function () {
            return strip_tags($this->property->details[0]->description);
        });

        add_filter('wpseo_opengraph_image', function () {
            return($this->media['photos'][0]->url != '' ? $this->media['photos'][0]->url : get_template_directory_uri() . '/img/nophoto.jpg');
        });

        add_filter('wpseo_canonical', function () {
            return get_the_permalink() . $this->property->rns_id . '/';
        });

        add_filter('wpseo_opengraph_url', function ($ogUrl) {
            return get_the_permalink() . $this->property->rns_id . '/';
        });
    }
}
