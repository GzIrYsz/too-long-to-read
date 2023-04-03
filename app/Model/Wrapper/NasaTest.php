<?php
require 'Nasa.php';

$nasa = new \Model\Wrapper\Nasa("DEMO_KEY");

$response = $nasa->getApod();
echo 'testBefore';
echo $response->getStatusCode();
echo 'testAfter';