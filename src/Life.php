<?php

namespace MidoriKocak\GameOfLife;

/**
 * Class Life
 * @package MidoriKocak\GameOfLife
 */
class Life
{
    /**
     * World object acts as an info card.
     *
     * @var World
     */
    private $world;

    /**
     * DAO of organisms
     *
     * @var Organisms
     */
    private $organisms;

    /**
     * Keeps the number of current generation.
     *
     * @var int
     */
    private $generations = 0;

    /**
     * Life constructor.
     * @param World $world
     * @param Organisms $organisms
     */
    public function __construct(World $world, Organisms $organisms)
    {
        $this->world = $world;
        $this->organisms = $organisms;
    }

    /**
     * Initializes the game
     *
     * @param bool $verbose
     */
    public function start($verbose = true)
    {
        if ($this->generations == 0) {
            while ($this->generations < $this->world->getIterations()) {
                $this->organisms->iterate();
                if ($verbose) {
                    self::printMatrixCli($this->organisms->getCells());
                }
                $this->generations++;
            }
        }
    }

    /**
     * Shows if the game reached max iteration
     *
     * @return bool
     */
    public function isEnded()
    {
        return $this->generations == $this->world->getIterations();
    }

    /**
     * Helper method to print organisms to CLI.
     *
     * @param $matrix
     */
    private static function printMatrixCli($matrix)
    {
        system('clear');
        $colors = [
            "0;34",
            "0;32",
            "0;36",
            "0;31",
            "0;35",
            "0;33",
            "0;37",
            "1;30",
            "1;34",
            "1;32",
            "1;36",
            "1;31",
            "1;35",
            "1;33",
            "1;37"
        ];

        for ($i = 0; $i < sizeof($matrix); $i++) {
            $out = implode($matrix[$i]) . "\n";
            for ($k = 0; $k < strlen($out); $k++) {
                if ($out[$k] > 0) {
                    $colorNumber = $out[$k] % 16;
                    echo "\033[" . $colors[$colorNumber] . "m" . $out[$k] . "\033[0m";
                } else {
                    echo $out[$k];
                }
            }
        }
        usleep(100000);
    }

}