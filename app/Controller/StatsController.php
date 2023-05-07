<?php

namespace App\Controller;

use App\Model\Chart\BarChart;
use App\Model\Chart\Element\Bar;
use Core\Controller\AbstractController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class StatsController extends AbstractController {

    public function index(Request $req, Response $res, array $args): Response {
        $barChart = $this->getAccessedBooksChart();
        $nbVisit = file_get_contents("../data/hit-counter.txt");
        /************************************/
        $author = 'Thomas REMY';
        $description = 'Cette page présente les statistiques du site.';
        $keywords = 'stats, statistiques, livres';
        $title = 'Statistiques';
        $lastBookId = $_COOKIE['lastBookId'] ?? null;
        $res->getBody()->write($this->render('stats', compact('author',
            'description', 'keywords', 'title', 'lastBookId', 'barChart', 'nbVisit')));
        return $res;
    }

    private function getAccessedBooksChart(): BarChart|null {
        $barChart = new BarChart("Titre des livres", "Nombre de consultations");
        $topFive = $this->getTopFiveAccessedBooks();
        if (empty($topFive)) {
            return null;
        }
        foreach ($topFive as $topElement) {
            $barChart->addBar(new Bar($topElement[2], $topElement[0], $topElement[1]));
        }
        return $barChart;
    }

    private function getTopFiveAccessedBooks(): array|null {
        $FILE_PATH = "../data/accessedBooks.csv";
        $topFive = [];
        if (!file_exists($FILE_PATH)) {
            return null;
        }
        $handle = fopen($FILE_PATH, 'r');
        $currentLign = fgetcsv($handle);
        while (($currentLign = fgetcsv($handle)) != false) {
            if (count($topFive) < 5) {
                $topFive[] = $currentLign;
            } else {
                for ($i = 0; $i < count($topFive); $i++) {
                    if ($currentLign[0] > $topFive[$i][0]) {
                        $topFive[$i] = $currentLign;
                        break;
                    }
                }
            }
        }
        fclose($handle);
        return $topFive;
    }
}