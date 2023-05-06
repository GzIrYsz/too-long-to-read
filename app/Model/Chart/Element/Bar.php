<?php
declare(strict_types=1);

namespace App\Model\Chart\Element;

class Bar {
    private string $label;
    private string|null $info;
    private float $value;

    public function __construct(string $label, float $value, string|null $info) {
        $this->label = $label;
        $this->value = $value;
        $this->info = $info;
    }

    /**
     * @return string
     */
    public function getLabel(): string {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getInfo(): string {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo(string $info): void {
        $this->info = $info;
    }

    /**
     * @return float
     */
    public function getValue(): float {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value): void {
        $this->value = $value;
    }
}