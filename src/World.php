<?php

namespace MidoriKocak\GameOfLife;

/**
 * Class World
 * @package MidoriKocak\GameOfLife
 */
class World
{
    /**
     * Size of the square matrix.
     *
     * @var int
     */
    private $cells;

    /**
     * Number of max iterations.
     *
     * @var int
     */
    private $iterations;

    /**
     * Number of max species.
     *
     * @var int
     */
    private $species;

    /**
     * World constructor.
     *
     * @param int $cells
     * @param int $species
     * @param int $iterations
     */
    public function __construct(int $cells, int $species, int $iterations)
    {
        $this->setCells($cells);
        $this->setIterations($iterations);
        $this->setSpecies($species);
    }

    /**
     * Returns the size of the square matrix.
     *
     * @return int
     */
    public function getCells(): int
    {
        return $this->cells;
    }

    /**
     * Set's the size of the square matrix.
     *
     * @param int $cells
     */
    public function setCells(int $cells)
    {
        $this->cells = $cells;
    }

    /**
     * Returns the number of max iterations.
     *
     * @return int
     */
    public function getIterations(): int
    {
        return $this->iterations;
    }

    /**
     * Sets the number of max iterations.
     *
     * @param int $iterations
     */
    public function setIterations(int $iterations)
    {
        $this->iterations = $iterations;
    }

    /**
     * Returns the number of max species.
     *
     * @return int
     */
    public function getSpecies(): int
    {
        return $this->species;
    }

    /**
     * Sets the number of max species.
     *
     * @param int $species
     */
    public function setSpecies(int $species)
    {
        $this->species = $species;
    }
}