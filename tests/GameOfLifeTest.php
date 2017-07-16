<?php
use MidoriKocak\GameOfLife\GameOfLife;

class GameOfLifeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GameOfLife
     */
    private $gameOflife;

    /**
     * @var
     */
    private $cellsArray;

    public function setup()
    {
        $this->gameOflife = new GameOfLife('./data/glider_gun_with_2_species.xml');
    }

    public function testStart()
    {
        $this->gameOflife->start(false);
        while (!$this->gameOflife->life->isEnded()) {
            usleep(100);
        }
        $this->assertTrue($this->gameOflife->life->isEnded());
    }

    public function testCreateSquareMatrixWithZeors()
    {
        $this->assertEquals([[0, 0], [0, 0]], $this->gameOflife::createSquareMatrixWithZeors(2));
    }

    public function testCreateRandomMatrix()
    {
        $this->assertNotNull($this->gameOflife::createRandomMatrix(4, 4, 2));
    }

    public function testCreateCellsFromXXML()
    {
        $xml = new DOMDocument();
        $xml->load('data/glider_gun_with_2_species.xml');
        $cellsArray = $this->gameOflife::createCellsFromXML($xml);
        $cellsArrayToCompare = json_decode(file_get_contents('data/cellsArray.json'), true);
        $this->assertEquals($cellsArray, $cellsArrayToCompare);
    }

    public function testCreateXMLFromCells()
    {

        $cells = json_decode(file_get_contents('data/cellsArray.json'), true);
        $this->gameOflife::createXMLfromCells('data/compare.xml', $cells, 2, 10);
        $xml = new DOMDocument();
        $xml->load('data/compare.xml');
        $cellsArrayToCompare = $this->gameOflife::createCellsFromXML($xml);
        $this->assertEquals($cellsArrayToCompare, $cells);
        unlink('data/compare.xml');
    }

}