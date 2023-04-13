<?php

namespace Core\Controller;

use Throwable;

class ViewDoesNotExistsException extends \Exception {
    private string $path;

    /**
     * The default constructor.
     *
     * @param string $path The incorrect path of the view.
     * @param string $message The custom message explaining the exception.
     * @param Throwable|null $previous The previous exception thrown, null otherwise
     */
    public function __construct(string $path, string $message = "", ?Throwable $previous = null) {
        parent::__construct($message, 0, $previous);
        $this->path = $path;
    }

    /**
     * @return string The incorrect path of the view.
     */
    public function getPath(): string
    {
        return $this->path;
    }


}