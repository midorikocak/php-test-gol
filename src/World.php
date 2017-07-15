<?php
/**
 * Created by PhpStorm.
 * User: midorikocak
 * Date: 15/07/2017
 * Time: 16:44
 */

namespace MidoriKocak;


class World
{
    /**
     * @var int
     */
    private $cells;

    /**
     * @var int
     */
    private $iterations;

    /**
     * @var int
     */
    private $species;

    public function __construct(int $cells, int $species, int $iterations)
    {
        $this->setCells($cells);
        $this->setIterations($iterations);
        $this->setSpecies($species);
    }

    /**
     * @return int
     */
    public function getCells(): int
    {
        return $this->cells;
    }

    /**
     * @param int $cells
     */
    public function setCells(int $cells)
    {
        $this->cells = $cells;
    }

    /**
     * @return int
     */
    public function getIterations(): int
    {
        return $this->iterations;
    }

    /**
     * @param int $iterations
     */
    public function setIterations(int $iterations)
    {
        $this->iterations = $iterations;
    }

    /**
     * @return int
     */
    public function getSpecies(): int
    {
        return $this->species;
    }

    /**
     * @param int $species
     */
    public function setSpecies(int $species)
    {
        $this->species = $species;
    }


}