<?php

namespace App\Http\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RandomWordApi
{
    protected string $url = "https://random-word-form.herokuapp.com/random/noun";
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getRandomWords(int $count = 1): array{
        try {
            $response = $this->client->get($this->url.'?count='.$count);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            throw new \Exception('Random Word API is unavailable right now.');
        }
    }
}
