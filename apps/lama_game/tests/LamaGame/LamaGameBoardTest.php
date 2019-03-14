<?php
/**
 * Created by PhpStorm.
 * User: elama
 * Date: 04.03.19
 * Time: 12:08
 */

namespace App\Tests\LamaGame;

use App\LamaGame\Direction;
use App\LamaGame\Lama;
use App\LamaGame\LamaAbstractGameBoard;
use App\LamaGame\ScareException;
use PHPUnit\Framework\TestCase;

class LamaGameBoardTest extends TestCase
{
    public function testCorrectLamaMoving()
    {
        $gameBoard = new LamaAbstractGameBoard(10);
        $gameBoard->move(Direction::South);
        $this->assertEquals($gameBoard->getPoint(), new Lama(0, $gameBoard->getBoardSize()-2));
    }

    public function testCaseWhenLamaTryToLeaveFieldBorder()
    {
        $gameBoard = new LamaAbstractGameBoard(10);
        $gameBoard->move(Direction::West);
        $this->assertEquals($gameBoard->getPoint(), new Lama(0 + $gameBoard->getScareStepsNum(),
            $gameBoard->getBoardSize()-1));
    }


}