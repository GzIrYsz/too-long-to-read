<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthorController extends \Core\Controller\AbstractController {

    public function index(Request $req, Response $res, array $args): Response {
        return $res;
    }
}