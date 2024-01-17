<?php

namespace App\Services\Content;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use rafael079\Readability\Configuration;
use rafael079\Readability\Readability;

class ExternalContentService
{

    /**
     * @var PendingRequest
     */
    protected PendingRequest $client;

    public function __construct()
    {
        $headers = [
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            'Accept-Language' => 'en-US,en,pt-BR,pt;q=0.8',
            'Accept-Encoding' => 'gzip, deflate, sdch',
            'Upgrade-Insecure-Requests' => 1,
            'Referer' => '',
            'Connection' => 'keep-alive'
        ];

        $options = [
            'useragent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
            'verify' => false,
        ];

        $this->client = Http::withHeaders($headers)->withOptions($options);
    }

    public function get(string $url): object
    {
        $response = $this->client->get(trim($url));

        return $this->readContent($response->body(), $url);
    }

    private function readContent(string $body, string $url): object
    {
        $data = [];

        $config = new Configuration([
            'FixRelativeURLs' => true,
            'OriginalURL' => $url,
            'SummonCthulhu' => true
        ]);

        $readability = new Readability($config);
        $readability->parse($body);


        if ($readability->getTitle()) {
            $data['title'] = $readability->getTitle();
        }

        if ($readability->getExcerpt()) {
            $data['excerpt'] = trim(strip_tags($readability->getExcerpt()));
        }

        if (!empty($readability->getImages())) {

            $images = $readability->getImages();

            if ((is_array($images) && count($images) > 1)) {
                $data['images'][] = array_shift($images);
            } else {
                $data['images'] = $images;
            }
        }

        return (object) $data;
    }
}