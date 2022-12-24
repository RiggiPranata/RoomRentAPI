<?php

use APP\Models\Model_login;
use Firebase\JWT\JWT;

function getJWT($authenticationHeader)
{
    if (is_null($authenticationHeader)) {
        throw new Exception("Otentikasi JWT Gagal!");
    }
    return explode(" ", $authenticationHeader)[1];
}
function validationJWT($encodedToken)
{
    $key = getenv('JWT_SECRET_KEY');
    $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);
    $modelAuth = new Model_login();

    $modelAuth->getEmail($decodedToken->email);
}
function createJWT($email)
{
    $timeRequest = time();
    $timeToken = getenv('JWT_TIME_TO_LIVE');
    $expTime = $timeRequest + $timeToken;
    $payload = [
        'email' => $email,
        'iat' => $timeRequest,
        'exp' => $expTime,
    ];

    $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'));
    return $jwt;
}
