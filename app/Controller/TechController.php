<?php

namespace App\Controller;

use App\Model\Wrapper\Nasa;
use Core\Controller\AbstractController;
use Dotenv\Dotenv;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TechController extends AbstractController {

    public function index(Request $req, Response $res, array $args): Response {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->safeLoad();
        $nasa = new Nasa($_ENV['NASA_TOKEN']);
        $result = $nasa->getApod()->getBody()->getContents();
        $apod = json_decode($result);
        /************************************/
        $author = 'Thomas REMY';
        $description = "La page Tech présente les technologies utilisées pour la création de ce site web.";
        $keywords = 'tech, nasa, image, espace, technologies, api';
        $title = 'Tech';
        $lastBookId = $_COOKIE['lastBookId'] ?? null;
        $res->getBody()->write($this->render('tech', compact('author', 'description', 'keywords', 'title', 'apod')));
        return $res;
    }
}