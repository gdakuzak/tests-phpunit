<?php

use PHPUnit\Framework\TestCase;
use Gdakuzak\Area;

class MyFirstTest extends TestCase 
{
    // phpunit MyFirstTest
    public function testArray() {
        $array = [2];
        $this->assertNotEmpty($array);
    }

    public function testeArea(){
        $area = new Area();
        $this->assertEquals(6,$area->getArea(2,3));
    }

}