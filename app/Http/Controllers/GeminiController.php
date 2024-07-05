<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Support\Facades\Config;

class GeminiController extends Controller
{
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:';
    protected $projectId = 'generateContent';

    public function __construct()
    {
        $this->apiKey = Config::get('services.gemini.api_key');
    }

    public function query($query)
    {
        if (!$query) {
            throw new \Exception('Query parameter is required');
        }

        $client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        try {
            $response = $client->request('POST', "generateContent?key={$this->apiKey}", [
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $query,
                                ],
                            ],
                        ],
                    ],
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch response from Gemini API: ' . $e->getMessage());
        }
    }
}
