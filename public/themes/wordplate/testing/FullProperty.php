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
        $client = new Client(['base_uri' => 'https://rns.mexicobeachvacations.com/', 'http_errors' => false]);
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
            $propertyType = 'Rental';
            $longTermRental = 40;
            $vacationRental = 41;
            foreach ($this->property->search_criteria as $searchCriteria) {
                if ($vacationRental == $searchCriteria->rns_id) {
                    $propertyType = $searchCriteria->name;
                } elseif ($longTermRental == $searchCriteria->rns_id) {
                    $propertyType = $searchCriteria->name;
                }
            }
            $metaTitle = $title . ' | ' . $propertyType . ' | ' . get_bloginfo('name');
            return $metaTitle;
        });

        add_filter('wpseo_metadesc', function () {
            $description = $this->property->details[0]->description;
            $description = strlen($description) > 300 ? substr($description, 0, 300) . '...' : $description;
            return $description;
        });

        add_filter('wpseo_opengraph_image', function () {
            return null;
        });

        add_action('wpseo_opengraph', function () {
            $imageParts = getimagesize($this->property->images[0]->url);

            echo '<meta property="og:image" content="' .  $this->property->images[0]->url . '" />', "\n";
            echo '<meta property="og:image:secure_url" content="' . str_replace('http://', 'https://', $this->property->images[0]->url) . '" />', "\n";
            echo '<meta property="og:image:width" content="' .  $imageParts['0'] . '" />', "\n";
            echo '<meta property="og:image:height" content="' .  $imageParts['1'] . '" />', "\n";
        });

        add_filter('wpseo_og_og_image_width', function () {
            return null;
        });

        add_filter('wpseo_og_og_image_height', function () {
            return null;
        });

        add_filter('wpseo_canonical', function () {
            return get_the_permalink() . $this->property->rns_id . '/';
        });

        add_filter('wpseo_opengraph_url', function ($ogUrl) {
            return get_the_permalink() . $this->property->rns_id . '/';
        });
    }
}
