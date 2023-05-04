<?php
require __DIR__ . '/../../../vendor/autoload.php';

$ol = new \App\Model\Wrapper\OpenLibrary();

$response = $ol->searchForAuthor('rowling');
$olid = '';
$response->then(function (\Psr\Http\Message\ResponseInterface $res) use (&$olid) {
    $res = $res->getBody()->getContents();
    $content = json_decode($res);
    $olid = $content->docs[0]->key;
},
    function (\GuzzleHttp\Exception\RequestException $e) {
        echo $e->getMessage();
    });
$response->wait();
var_dump($olid);