<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookController extends \Core\Controller\AbstractController {
    public function index(Request $req, Response $res, array $args): Response {
        $res->getBody()->write($this->render('book'));
        return $res;
    }
}