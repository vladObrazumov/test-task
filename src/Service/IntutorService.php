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
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function getCatalogs(): array
    {
        $response = $this->client->request("GET", self::VLAD_API_URI);
        $arrayOfCatalogs = json_decode($response->getBody()->getContents(), true);
        if ($arrayOfCatalogs === null) {
            throw new \Exception("Json can't be decoded");
        }

        return $arrayOfCatalogs;
    }
}
