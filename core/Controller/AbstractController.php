<?php
declare(strict_types=1);

namespace Core\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;

abstract class AbstractController {
    private const TEMPLATES_DIR = __DIR__ . '/../../templates/';
    private const LAYOUT_PATH = self::TEMPLATES_DIR . 'layout/layout.php';

    public function render(string $templateName, array $data = []): string {
        extract($data);
        $templatePath = self::TEMPLATES_DIR . $templateName . '.php';

        if (!file_exists($templatePath)) {
            throw new ViewDoesNotExistsException("This view file does not exists");
        }

        ob_start();
        include($templatePath);
        $content = ob_get_clean();
        ob_start();
        include(self::LAYOUT_PATH);
        return ob_get_clean();
    }

    public abstract function index(Request $req, Response $res, array $args): Response;
}