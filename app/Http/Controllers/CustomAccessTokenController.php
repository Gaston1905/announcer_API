<?php

namespace App\Http\Controllers;

use Laravel\Passport\Http\Controllers\AccessTokenController as BaseAccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class CustomAccessTokenController extends BaseAccessTokenController
{
    /**
     * Personaliza la respuesta JSON del token.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface  $request
     * @return array
     */
    public function issueToken(ServerRequestInterface $request)
    {
        $response = parent::issueToken($request);

        // Personaliza la respuesta aquí según tus necesidades
        $content = json_decode($response->getContent(), true);
        $token = $content['access_token'];

        return [
            'token' => $token,
        ];
    }
}
