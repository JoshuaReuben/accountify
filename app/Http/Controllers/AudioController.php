<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\File\File;

class AudioController extends Controller
{
    public function serveAudio(Request $request, $filename)
    {


        $filePath = storage_path('app/public/musics/' . $filename);
        $file = new File($filePath);

        $response = Response::stream(
            function () use ($filePath) {
                echo file_get_contents($filePath);
            },
            200,
            [
                'Content-Type' => $file->getMimeType(),
                'Content-Length' => $file->getSize(),
                'Accept-Ranges' => 'bytes',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Connection' => 'Keep-Alive',
            ]
        );

        return $response;
    }
}
