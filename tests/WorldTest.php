<?php
use MidoriKocak\GameOfLife\World;

class WorldTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \MidoriKocak\GameOfLife\World
     */
    private $world;

    public function setup()
    {
        $this->world = new World(40, 2, 10);
    }

    public function testGetCells()
    {
        $this->assertEquals($this->world->getCells(), 40);
    }

    public function testSetCells()
    {
        $this->world->setCells(50);
        $this->assertEquals($this->world->getCells(), 50);
    }

    public function testGetIterations()
    {
        $this->assertEquals(10, $this->world->getIterations());
    }

    public function testSetIterations()
    {
        $this->world->setIterations(20);
        $this->assertEquals(20, $this->world->getIterations());
    }

    public function tetsGetSpecies()
    {
        $this->assertEquals($this->world->getSpecies(), 2);
    }

    public function testSetSpecies()
    {
        $this->world->setSpecies(4);
        $this->assertEquals(4, $this->world->getSpecies());
    }

}