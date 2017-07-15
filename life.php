<?php

require "vendor/autoload.php";

$gameOfLife = new \MidoriKocak\GameOfLife('data/glider_gun_with_2_species.xml');
$gameOfLife->start();
