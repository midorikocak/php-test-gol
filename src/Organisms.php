<?php

namespace MidoriKocak;


class Organisms
{
    /**
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

    public function iterate()
    {
        $next = $this->cells;

        for ($i = 0; $i < sizeof($this->cells); $i++) {
            for ($j = 0; $j < sizeof($this->cells[0]); $j++) {
                $next[$i][$j] = $this->checkCell($i, $j);
            }
        }

        $this->cells = $next;
    }

    public function getCells()
    {
        return $this->cells;
    }

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

    private function checkCell($i, $j)
    {
        $neighbors = $this->getNeighborCount($i, $j);
        if ($this->cells[$i][$j] > 0) {
            if ($neighbors[$this->cells[$i][$j]] == 2 || $neighbors[$this->cells[$i][$j]] == 3) {
                return $this->cells[$i][$j];
            } elseif ($neighbors[$this->cells[$i][$j]] < 2) {
                return 0;
            } elseif ($neighbors[$this->cells[$i][$j]] >= 4) {
                return 0;
            }
        } else {
            $speciesEqualToTree = [];
            foreach ($neighbors as $type => $count) {
                if ($count == 3) {
                    array_push($speciesEqualToTree, $type);
                }
            }

            if (!empty($speciesEqualToTree)) {
                return $speciesEqualToTree[rand(0, sizeof($speciesEqualToTree) - 1)];
            } else {
                return 0;
            }
        }
        return 0;
    }

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