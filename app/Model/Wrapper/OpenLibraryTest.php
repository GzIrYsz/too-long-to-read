<?php
require 'vendor/autoload.php';

$ol = new \App\Model\Wrapper\OpenLibrary();

$response = $ol->getWorksBySubject("drama");
$response->then(function (\Psr\Http\Message\ResponseInterface $res) {
    $res = $res->getBody()->getContents();
    $content = json_decode($res);
    print_r($content);
},
    function (\GuzzleHttp\Exception\RequestException $e) {
        echo $e->getMessage();
    });
$response->wait();