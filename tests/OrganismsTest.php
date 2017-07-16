<?php
require "../vendor/autoload.php";
use MidoriKocak\GameOfLife\Organisms;

class OrganismsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Organisms
     */
    private $organisms;

    /**
     * @var int[][]
     */
    private $cells;

    public function setup()
    {
        $this->cells = json_decode(file_get_contents('data/cellsArray.json'), true);
        $this->organisms = new Organisms($this->cells);
    }

    public function testGetCells()
    {
        $this->assertEquals($this->organisms->getCells(), $this->cells);
    }

    public function testIterate()
    {
        $this->organisms->iterate();
        $this->assertNotEquals($this->organisms->getCells(), $this->cells);
    }
}