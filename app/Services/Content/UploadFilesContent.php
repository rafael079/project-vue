<?php

namespace App\Services\Content;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;
use Carbon\Carbon;

class UploadFilesContent
{

    public function uploadByUrl(array $urlImages, Post $post)
    {
        $options = [
            'http' => [
                'method' => "GET",
                'header' => "en-US,en,pt-BR,pt;q=0.5\r\n" .
                    "Referer: ''\r\n" .
                    "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13')\r\n"
            ]
        ];

        $context = stream_context_create($options);

        foreach ($urlImages as $file) {

            $information = pathinfo($file);

            $name = strtolower(Carbon::now()->format('dmY') . '.' . time() . md5(time()) . '.' . ($information['extension'] ?? 'webp'));
            $content = base64_encode(file_get_contents($file, false, $context));

            $post->addMediaFromBase64($content)->usingFileName($name)->toMediaCollection('content');

        }
    }

    public function upload(array $uploadedFile, Post $post): void
    {
        foreach ($uploadedFile as $file) {
            $extension = $file->getClientOriginalExtension();
            $name = strtolower(Carbon::now()->format('dmY') . '.' . time() . md5(time()) . '.' . $extension);

            $post->addMedia($file)->usingFileName($name)->toMediaCollection('content');
        }
    }
}