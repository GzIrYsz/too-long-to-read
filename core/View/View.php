<?php
declare(strict_types=1);

namespace Core\View;

/**
 * This class represents a view.
 *
 * @author Thomas REMY <contact.t.remy777@gmail.com>
 */
class View {
    private string $path;
    private array $data;

    /**
     * The default constructor.
     *
     * @param string $path The path to the view.
     * @param array $data The data to render.
     */
    public function __construct(string $path, array $data = []) {
        $this->path = $path;
        $this->data = $data;
    }

    /**
     * Render the view.
     *
     * @throws ViewDoesNotExistsException If the path is incorrect or the view does not exist.
     */
    public function render(): void {
        if (!file_exists($this->path)) {
            throw new ViewDoesNotExistsException("This view file does not exists");
        }
        extract($this->data);
        include($this->path);
    }
}