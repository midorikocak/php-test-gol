<?php

namespace MidoriKocak\GameOfLife;

/**
 * Class GameOfLife
 *
 * A simple standalone OOP, Connway's gameoflife implementation with PHP.
 * API of Program
 *
 * @package MidoriKocak\GameOfLife
 */
class GameOfLife
{
    /**
     * @var \DOMDocument
     */
    private $xml;

    /**
     * @var Life
     */
    public $life;

    /**
     * @var World
     */
    private $world;

    /**
     * @var Organisms
     */
    private $organisms;

    /**
     * @var int
     */
    private $size;

    /**
     * @var int
     */
    private $iterations;

    /**
     * @var int
     */
    private $species;

    /**
     * @var string
     */
    private $outputFilename = "out.xml";

    /**
     * GameOfLife constructor.
     *
     * @param string $filename
     * @param string|null $outputFilename
     */
    public function __construct(string $filename, string $outputFilename = null)
    {
        $this->loadXML($filename);

        if ($outputFilename != null) {
            $this->outputFilename = $outputFilename;
        }

        $world = $this->xml->getElementsByTagName('world')->item(0);
        $this->size = $world->getElementsByTagName('cells')->item(0)->nodeValue;
        $this->iterations = $world->getElementsByTagName('iterations')->item(0)->nodeValue;
        $this->species = $world->getElementsByTagName('species')->item(0)->nodeValue;

        $this->createWorld();
        $this->createOrganisms();
        $this->createLife();
    }

    /**
     * Loads the inital XML file. Always runs.
     *
     * @param $filename
     * @return bool
     * @throws \Exception
     */
    private function loadXML($filename)
    {
        if (!file_exists($filename)) {
            throw new \Exception('File not found.');
        }

        $handler = fopen($filename, "r");

        if (!$handler) {
            throw new \Exception('File open failed.');
        }

        $xmlString = stream_get_contents($handler);
        $this->xml = new \DOMDocument();
        $this->xml->loadXML($xmlString);
        fclose($handler);

        return true;
    }

    /**
     * Starts the game
     *
     * @param bool $verbose
     * @return bool
     * @throws \Exception
     */
    public function start($verbose = true)
    {
        if ($this->organisms == null || $this->species == null || $this->iterations == null) {
            throw new \Exception('Not ready yet');
        }

        $this->life->start($verbose);

        if (!$this->life->isEnded()) {
            throw new \Exception('You cannot generate output while life continues');
        }

        if ($this->life->isEnded()) {
            self::createXMLfromCells("data/" . $this->outputFilename, $this->organisms->getCells(), $this->species, $this->iterations);
        }

        return true;
    }

    /**
     * Creates the life of game.
     *
     * @throws \Exception
     */
    private function createLife()
    {
        if ($this->organisms !== null && $this->world !== null) {
            $this->life = new Life($this->world, $this->organisms);
        } else {
            throw new \Exception('Not ready yet');
        }
    }

    /**
     * Creates the World of game.
     *
     * @throws \Exception
     */
    private function createWorld()
    {
        if ($this->size == null || $this->species == null | $this->iterations == null) {
            throw new \Exception('Not ready yet');
        }

        if ($this->size < 0 || $this->species < 0 || $this->iterations < 0) {
            throw new \InvalidArgumentException("World arguments should be positive.");
        }

        $this->world = new World($this->size, $this->species, $this->iterations);
    }

    /**
     * Creates organisms of game.
     *
     * @throws \Exception
     */
    private function createOrganisms()
    {
        if ($this->size == null || $this->species == null) {
            throw new \Exception('Not ready yet');
        }

        if ($this->size < 0 || $this->species < 0) {
            throw new \InvalidArgumentException("Organisms arguments should be positive.");
        }

        $cellsArray = self::createCellsFromXML($this->xml);
        $this->checkCells($cellsArray, $this->species);

        $this->organisms = new Organisms($cellsArray);
    }

    /**
     * Helper function to generate array of cells from XML DomDocument.
     *
     * @param \DOMDocument $xml
     * @return array
     */
    public static function createCellsFromXML(\DOMDocument $xml)
    {
        $world = $xml->getElementsByTagName('world')->item(0);
        $size = $world->getElementsByTagName('cells')->item(0)->nodeValue;

        $cellsArray = self::createSquareMatrixWithZeors($size);
        $organisms = $xml->getElementsByTagName('organism');

        /**
         * @var \DOMElement $organism
         */
        foreach ($organisms as $organism) {
            $j = $organism->getElementsByTagName('x_pos')->item(0)->nodeValue;
            $i = $organism->getElementsByTagName('y_pos')->item(0)->nodeValue;
            $value = $organism->getElementsByTagName('species')->item(0)->nodeValue;

            $cellsArray[$i][$j] = $value;
        }

        return $cellsArray;
    }

    /**
     * Creates XML file from matrix
     *
     * @param $filename
     * @param array $matrix
     * @param int $species
     * @param int $iterations
     */
    public static function createXMLfromCells($filename, array $matrix, int $species, int $iterations)
    {
        $domtree = new \DOMDocument('1.0', 'UTF-8');

        $xmlRoot = $domtree->createElement("life");

        $xmlRoot = $domtree->appendChild($xmlRoot);


        $world = $domtree->createElement("world");
        $xmlRoot->appendChild($world);

        $world->appendChild($domtree->createElement('cells', sizeof($matrix)));
        $world->appendChild($domtree->createElement('species', $species));
        $world->appendChild($domtree->createElement('iterations', $iterations));

        $organisms = $domtree->createElement("organisms");


        $xmlRoot->appendChild($organisms);

        for ($i = 0; $i < sizeof($matrix); $i++) {
            for ($j = 0; $j < sizeof($matrix[0]); $j++) {
                if ($matrix[$i][$j] !== 0) {
                    $organism = $domtree->createElement('organism');
                    $organism->appendChild($domtree->createElement('x_pos', $j));
                    $organism->appendChild($domtree->createElement('y_pos', $i));
                    $organism->appendChild($domtree->createElement('species', $matrix[$i][$j]));
                    $organisms->appendChild($organism);
                }
            }
        }

        file_put_contents($filename, $domtree->saveXML());
    }

    /**
     * Initializes a multidimensional array of zeros
     *
     * @param int $size
     * @return array
     */
    public static function createSquareMatrixWithZeors(int $size)
    {

        $matrix = array_fill(0, $size, array_fill(0, $size, 0));
        return $matrix;
    }

    /**
     * Creates a random array with integers up to $max
     *
     * @param int $n
     * @param int $m
     * @param int $max
     *
     * @return array
     */
    public static function createRandomMatrix(int $n, int $m, int $max)
    {
        $matrix = array_fill(0, $n, array_fill(0, $m, 0));

        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $m; $j++) {
                $matrix[$i][$j] = rand(0, $max);
            }
        }

        return $matrix;
    }

    /**
     * Checks if array cells are valid.
     *
     * @param int[][] $cells
     * @param int $species
     */
    private function checkCells(array $cells, int $species)
    {
        if (empty($cells) || empty($cells[0])) {
            throw new \InvalidArgumentException("Cells can't be empty");
        }
        for ($i = 0; $i < sizeof($cells); $i++) {
            for ($j = 0; $j < sizeof($cells[0]); $j++) {
                if ($cells[$i][$j] < 0 || $cells[$i][$j] > ($species + 1)) {
                    throw new \InvalidArgumentException("Cells can't be empty");
                }
            }
        }
    }

}