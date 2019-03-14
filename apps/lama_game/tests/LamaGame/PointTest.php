<?php
/**
 * Created by PhpStorm.
 * User: elama
 * Date: 04.03.19
 * Time: 11:54
 */

namespace App\Tests\LamaGame;

use App\LamaGame\Point;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testPointMoving()
    {
        $point = new Point(0,0);
        $point->move(-5, 5);

        $this->assertEquals($point, new Point(-5,5));
    }

    public function testPointReset()
    {
        $boardSize = 15;
        $point = new Point(512,128);
        $point->resetToOriginPosition($boardSize);

        $this->assertEquals($point, new Point(0, $boardSize-1));
    }
}