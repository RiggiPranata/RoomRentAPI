<?php

use APP\Models\Model_login;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($authHeader)
{
    if (is_null($authHeader)) {
        throw new Exception("Otentikasi JWT Gagal");
    }
    return explode(" ", $authHeader)[1];
}
function validationJWT($encodedToken)
{
    $key = getenv('JWT_SECRET_KEY');
    $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
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

    $jwt = JWT::encode($payload, getenv('JWT_SECTET_KEY'), 'HS256');
    return $jwt;
}
