<?php
require 'Nasa.php';

$nasa = new \Model\Wrapper\Nasa("DEMO_KEY");

$response = $nasa->getApod();
echo 'testBefore';
$response->then(function (\Psr\Http\Message\ResponseInterface $res) {
    print_r($res->getBody()->getContents());
},
function (\GuzzleHttp\Exception\RequestException $e) {
    echo $e->getMessage();
});
$response->wait();
echo 'testAfter';