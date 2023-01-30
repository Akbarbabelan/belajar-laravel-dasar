<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function createCookie(Request $request): Response
    {
        return Response("Hello Cookie")
            ->cookie("User-Id", "babelan", 1000, "/")
            ->cookie("Is-Member", "true", 1000, "/");

    }

    public function getCookie(Request $request): JsonResponse
    {
        return Response()
            ->json([
                "userId" => $request->cookie("User-Id", "guest"),
                "isMember" => $request->cookie("Is-Member", 'false')
            ]);
    }

    public function clearCookie(Request $request): Response
    {
        return Response("Clear Cookie")
            ->withoutCookie("User-Id")
            ->withoutCookie("Is-Member");
    }
}
