<?php
namespace Testing;

use GuzzleHttp\Client;

class FullProperty
{
    protected $mlsNumber;
    protected $property;

    public function __construct($mlsNumber='')
    {
        if ($mlsNumber=='') {
            $this->getMlsNumber();
        } else {
            $this->mlsNumber = $mlsNumber;
        }
        $this->create();
    }

    public function getProperty();
    {
        return $this->property;
    }

    public function getMlsNumber()
    {
        $pathFragments = explode('property/', $_SERVER['REQUEST_URI']);
        $this->mlsNumber = str_replace('/', '', end($pathFragments));
    }

    public function create()
    {
        $client = new Client(['base_uri' => 'https://rns.mexicobeachvacations.com/units/']);
        $apiCall = $client->request(
            'GET',
            'property/' . $this->mlsNumber
        );

        $results = json_decode($apiCall->getBody());
        $this->property = $results;

        return $results;
    }
    public function setPropertySeo()
    {
        add_filter('wpseo_title', function() {
            $title = $this->property->property_num . ' ' . $this->property->property_name;
            $title = ($this->property->preperty_num != '' ? $title . ' ' . $this->property->property_num : $title);
            $metaTitle = $title . ' | ' . get_bloginfo('name');
        });

        add_filter('wpseo_metadesc', function() {
            return strip_tags($this->property->remarks);
        });

        add_filter('wpseo_opengraph_image', function() {
            return($this->media'photos'][0]->url != '' ? $this->media['photos'][0]->url : get_template_directory_uri() . '/img/nophoto.jpg');
        });

        add_filter('wpseo_canonical', function(){
            return get_the_permalink() . $this->property->mls_account . '/';
        });

        add_filter('wpseo_opengraph_url', function{$ogUrl} {
            return get_the_permalink() . $this->property->mls_account . '/';
        });
    }
        
