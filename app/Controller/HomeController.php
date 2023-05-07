<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Core\Controller\AbstractController;

class HomeController extends AbstractController {
    public function index(Request $req, Response $res, array $args): Response {
        $author = 'Thomas REMY';
        $description = "Too Long To Read est un site de recherche de livres réalisé dans le cadre d'un projet universitaire de deuxième année de licence d'informatique";
        $keywords = 'TooLongToRead, TLTR, tltr, recherche, livre, livres, auteur, auteurs, ecrivain, écrivain, écrivains';
        $title = 'Accueil';
        $lastBookId = $_COOKIE['lastBookId'] ?? null;
        $res->getBody()->write($this->render('home', compact('author', 'description', 'keywords', 'title', 'lastBookId')));
        return $res;
    }
}