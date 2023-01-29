<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return Response("hello response");
    }

    public function header(Request $request): Response
    {
        $body = [
            'firstName' => 'Akbar',
            'lastName' => 'Babelan'
        ];

        return Response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author' => 'Programmer Zaman Now',
                'App' => 'Belajar Laravel'
            ]);
    }

    public function responseView(Request $request): Response
    {
        return Response()
            ->view('hello', ['name' => 'Akbar']);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = [
            'firstName' => "Akbar",
            'lastName' => "Babelan"
        ];
        return response()
            ->json($body);
    }

    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()
            ->file(storage_path('app/public/pictures/Babelan.png'));
    }

    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()
            ->download(storage_path('app/public/pictures/Babelan.png'));
    }
}
