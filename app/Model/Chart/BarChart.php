<?php
declare(strict_types=1);

namespace App\Model\Chart;

use App\Model\Chart\Element\Bar;

class BarChart {
    private int $nbBars;
    private array $bars;
    private float $minValue = 0;
    private float $maxValue = 0;
    private string $xlabel;
    private string $ylabel;

    public function __construct(string $xlabel, string $ylabel) {
        $this->xlabel = $xlabel;
        $this->ylabel = $ylabel;
    }

    /**
     * @return int
     */
    public function getNbBars(): int {
        return $this->nbBars;
    }

    /**
     * @param int $nbBars
     */
    private function setNbBars(int $nbBars): void {
        $this->nbBars = $nbBars;
    }

    /**
     * @return array
     */
    public function getBars(): array {
        return $this->bars;
    }

    public function getBar(int $i): Bar {
        return $this->bars[$i];
    }

    public function addBar(Bar $bar): void {
        $this->bars[] = $bar;
        $this->updateMinMax($bar->getValue());
        $this->nbBars = count($this->bars);
    }

    /**
     * @return float
     */
    public function getMinValue(): float {
        return $this->minValue;
    }

    /**
     * @param float $minValue
     */
    private function setMinValue(float $minValue): void {
        $this->minValue = $minValue;
    }

    /**
     * @return float
     */
    public function getMaxValue(): float {
        return $this->maxValue;
    }

    /**
     * @param float $maxValue
     */
    private function setMaxValue(float $maxValue): void {
        $this->maxValue = $maxValue;
    }

    private function updateMinMax(float $value): BarChart {
        if ($value < $this->getMinValue()) {
            $this->setMinValue($value);
        } elseif ($value > $this->getMaxValue()) {
            $this->setMaxValue($value);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getXlabel(): string {
        return $this->xlabel;
    }

    /**
     * @param string $xlabel
     */
    public function setXlabel(string $xlabel): void {
        $this->xlabel = $xlabel;
    }

    /**
     * @return string
     */
    public function getYlabel(): string {
        return $this->ylabel;
    }

    /**
     * @param string $ylabel
     */
    public function setYlabel(string $ylabel): void {
        $this->ylabel = $ylabel;
    }
}