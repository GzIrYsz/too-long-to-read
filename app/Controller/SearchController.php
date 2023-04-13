<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class SearchController extends \Core\Controller\AbstractController {
    public function index(Request $req, Response $res, array $args): Response {$author = 'Thomas REMY';
        $description = 'description';
        $keywords = 'a, b, c';
        $title = 'Test Page';
        $res->getBody()->write($this->render('search', compact('author', 'description', 'keywords', 'title')));
        return $res;
    }
}