<?php

namespace App\Service;

use GuzzleHttp\Client;

class IntutorService
{
    const SERVICE_HOST = 'http://intutor.no';
    const VLAD_API_URI = '/vlad_api.json';

    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::SERVICE_HOST,
            'timeout' => 50,
        ]);
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCatalogs()
    {
        $response = $this->client->request("GET", self::VLAD_API_URI);
        return $response->getBody()->getContents();
    }
}
