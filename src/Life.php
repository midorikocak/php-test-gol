<?php

namespace MidoriKocak\GameOfLife;


class Life
{
    private $world;
    private $organisms;
    private $generations = 0;

    public function __construct(World $world, Organisms $organisms)
    {
        $this->world = $world;
        $this->organisms = $organisms;
    }

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

    public function isEnded()
    {
        return $this->generations == $this->world->getIterations();
    }

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