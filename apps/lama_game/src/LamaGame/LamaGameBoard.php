<?php
/**
 * Created by PhpStorm.
 * User: Egor
 * Date: 14.03.2019
 * Time: 20:58
 */

namespace App\LamaGame;


class LamaGameBoard extends AbstractGameBoard
{
    public function __construct(int $boardSize)
    {
        parent::__construct($boardSize);
        $this->gamePiece = new Lama(0, $this->boardSize-1);
        $this->prepareToNewGame();
    }

    public function prepareToNewGame()
    {
        parent::prepareToNewGame();
        $this->status = "Я готова к прогулке, пойдем скорее гулять.";
    }

    public function move(int $direction): string
    {
        $this->finished = $this->stepsNum == $this->maxStepsNum - 1;
        if ($this->finished) {
            $this->status = "Я нагулялась, пойду ка домой.";
            return $this->status;
        }
        return parent::move($direction);

    }

}