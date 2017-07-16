<?php

namespace MidoriKocak\GameOfLife;

/**
 * Class Organisms
 *
 * @package MidoriKocak\GameOfLife
 */
class Organisms
{
    /**
     * Multidimensional array of organisms
     *
     * @var int[][]
     */
    private $cells;

    /**
     * Organisms constructor.
     * @param int[][] $cells
     */
    public function __construct(array $cells)
    {
        $this->cells = $cells;
    }

    /**
     * Runs the game.
     * Checks each cell for the next iteration.
     */
    public function iterate()
    {
        $next = $this->cells;
        $rows = sizeof($this->cells);
        $columns = sizeof($this->cells[0]);
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $columns; $j++) {
                $next[$i][$j] = $this->checkCell($i, $j);
            }
        }

        $this->cells = $next;
    }

    /**
     * Returns the array of cells
     *
     * @return array|\int[][]
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * Helper function to get neighbor count of matrix element
     *
     * @param $i
     * @param $j
     * @return array
     */
    private function getNeighborCount($i, $j)
    {
        $neighbors = [];
        $neighbors[$this->cells[$i][$j]] = 0;
        $indexes = self::getNeighborIndexes($this->cells, $i, $j);
        foreach ($indexes as $coordinate) {
            $y = $coordinate[0];
            $x = $coordinate[1];
            $type = $this->cells[$y][$x];

            if ($this->cells[$y][$x] > 0) {
                $neighbors[$type] = $neighbors[$type] ?? 0;
                $neighbors[$type]++;
            }
        }
        return $neighbors;
    }

    /**
     * Check the matrix cell if it will survive, die or reproduce.
     *
     * @param $i
     * @param $j
     * @return int|mixed
     */
    private function checkCell($i, $j)
    {
        $neighbors = $this->getNeighborCount($i, $j);
        if ($this->cells[$i][$j] > 0 &&
            ($neighbors[$this->cells[$i][$j]] == 2 || $neighbors[$this->cells[$i][$j]] == 3)
        ) {
            return $this->cells[$i][$j];
        } else {
            $speciesEqualToTree = [];
            foreach ($neighbors as $type => $count) {
                if ($count == 3) {
                    array_push($speciesEqualToTree, $type);
                }
            }

            if (!empty($speciesEqualToTree)) {
                return $speciesEqualToTree[rand(0, sizeof($speciesEqualToTree) - 1)];
            }
        }
        return 0;
    }

    /**
     * Helper method that returns indexes of neighbors of a Matrix element.
     *
     * @param $matrix
     * @param $i
     * @param $j
     * @return array
     */
    private static function getNeighborIndexes($matrix, $i, $j)
    {

        $indexes = [];

        if ($i > 0 && $j > 0) array_push($indexes, [$i - 1, $j - 1]);
        if ($i > 0) array_push($indexes, [$i - 1, $j]);
        if ($i > 0 && $j < sizeof($matrix[0]) - 1) array_push($indexes, [$i - 1, $j + 1]);
        if ($j > 0) array_push($indexes, [$i, $j - 1]);
        if ($j < sizeof($matrix[0]) - 1) array_push($indexes, [$i, $j + 1]);
        if ($i < sizeof($matrix) - 1 && $j > 0) array_push($indexes, [$i + 1, $j - 1]);
        if ($i < sizeof($matrix) - 1) array_push($indexes, [$i + 1, $j]);
        if ($i < sizeof($matrix) - 1 && $j < sizeof($matrix[0]) - 1) array_push($indexes, [$i + 1, $j + 1]);

        return $indexes;
    }

}