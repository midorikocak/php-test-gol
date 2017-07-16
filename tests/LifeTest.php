<?php
require "../vendor/autoload.php";
use MidoriKocak\GameOfLife\Life;

class LifeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Life
     */
    private $life;

    /**
     * @var \MidoriKocak\GameOfLife\World
     */
    private $world;
    private $organisms;

    public function setup()
    {
        $this->world = new \MidoriKocak\GameOfLife\World(40, 2, 10);
        $cells = json_decode(file_get_contents('data/cellsArray.json'), true);
        $this->organisms = new \MidoriKocak\GameOfLife\Organisms($cells);
        $this->life = new Life($this->world, $this->organisms);
    }

    public function testStart()
    {
        $this->life->start(false);
        $this->assertNotEquals($this->world->getIterations(), 0);
    }

    public function testIsEnded()
    {
        $this->life->start(false);
        while (!$this->life->isEnded()) {
            usleep(1000);
        }
        $this->assertTrue($this->life->isEnded());
    }
}