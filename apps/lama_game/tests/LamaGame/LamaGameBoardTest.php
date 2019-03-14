<?php
/**
 * Created by PhpStorm.
 * User: elama
 * Date: 04.03.19
 * Time: 12:08
 */

namespace App\Tests\LamaGame;

use App\LamaGame\Direction;
use App\LamaGame\GameBoard;
use App\LamaGame\AbstractGamePiece;
use App\LamaGame\ScareException;
use PHPUnit\Framework\TestCase;

class GameBoardTest extends TestCase
{
    public function testCorrectLamaMoving()
    {
        $gameBoard = new GameBoard(10);
        $gameBoard->move(Direction::South);
        $this->assertEquals($gameBoard->getPoint(), new AbstractGamePiece(0, $gameBoard->getBoardSize()-2));
    }

    public function testCaseWhenLamaTryToLeaveFieldBorder()
    {
        $gameBoard = new GameBoard(10);
        $gameBoard->move(Direction::West);
        $this->assertEquals($gameBoard->getPoint(), new AbstractGamePiece(0 + $gameBoard->getScareStepsNum(),
            $gameBoard->getBoardSize()-1));
    }


}