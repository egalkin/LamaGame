<?php
/**
 * Created by PhpStorm.
 * User: elama
 * Date: 27.02.19
 * Time: 17:52
 */

namespace App\LamaGame;

use App\LamaGame\Exception\ScareException;

/**
 * Class GameBoard
 * @package App\LamaGame
 */
class GameBoard
{

    private static $walkingMessage = "До конца прогулки осталось: ";

    /**
     * Размер доски
     *
     * @var int
     */
    private $boardSize;

    /**
     * Точка отвечающая за положение фигуры на доске
     *
     * @var Point
     */
    private $curState;

    /**
     * Число шагов после которых игра завершается
     *
     * @var int
     */
    private $maxStepsNum;

    /**
     * Число пройденный шагов
     *
     * @var int
     */
    private $stepsNum;

    /**
     * Число шагов на которое фигура уходи вглубь поля в случае попытки выйти за границу
     * @var int
     */
    private $scareStepsNum;

    /**
     * Текущий статус игры
     *
     * @var string
     */
    private $status;

    /**
     * Показывает завершена ли игра или нет.
     *
     * @var bool
     */
    private $finished;

    public function __construct(int $boardSize)
    {
        $this->boardSize = $boardSize;
        $this->maxStepsNum = 15;
        $this->scareStepsNum = $this->boardSize / 3;
        $this->curState = new Point(0, $boardSize-1);
        $this->prepareToNewGame();
    }


    /**
     * Готовит внутреннее состояние поля к новой игре.
     *
     */
    public function prepareToNewGame()
    {
        $this->curState->resetToOriginPosition($this->boardSize);
        $this->stepsNum = 0;
        $this->status = "Я готова к прогулке, пойдем скорее гулять.";
        $this->finished = false;
    }

    public function isFinished()
    {
        return $this->finished;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPoint(): Point
    {
        return $this->curState;
    }

    public function getScareStepsNum(): int
    {
        return $this->scareStepsNum;
    }


    public function getBoardSize(): int
    {
        return $this->boardSize;
    }


    /**
     * Основная функция класса, отвечающая за движение по полю.
     * В зависимости от переданного направления, вызывает нужную
     * функцию движения, с параметров соответсвующим направлению.
     * Если функция движения выкинула exception изменяет статус игры.
     *
     * @param int $direction
     * @return string
     */
    public function move(int $direction): string
    {
        $this->finished = $this->stepsNum == $this->maxStepsNum-1;
        if ($this->finished) {
            $this->status = "Я нагулялась, пойду ка домой.";
        } else {
            try {
                switch ($direction) {
                    case Direction::North:
                        $this->moveY(1);
                        break;
                    case Direction::South:
                        $this->moveY(-1);
                        break;
                    case Direction::West:
                        $this->moveX(-1);
                        break;
                    case Direction::East:
                        $this->moveX(1);
                        break;
                }
            } catch (ScareException $ex) {
                $this->status = $ex->getMessage();
            }
            $this->stepsNum++;
        }
        return $this->status;
    }



    /**
     * Изменяет положение точки по оси X.
     * В случае успеха изменяет статус игры.
     * В случае если происходит попытка выйти за пределы поля
     * сдвигает точку внутрь поля на $scareStepsNum и кидает exception.
     *
     * @param int $dx
     * @throws ScareException
     */
    private function moveX(int $dx)
    {
        $newPosition = $this->curState->getX() + $dx;
        if ($newPosition >= 0 && $newPosition < $this->boardSize) {
            $this->curState->move($dx, 0);
            $this->status = self::$walkingMessage . ($this->maxStepsNum - $this->stepsNum - 1) .  " шагов";
            return;
        } else {
            if ($newPosition < 0) {
                $this->curState->move($this->scareStepsNum, 0);
            } else {
                $this->curState->move(-$this->scareStepsNum, 0);
            }
            throw new ScareException();
        }
    }


    /**
     * Изменяет положение точки по оси Y.
     * В случае успеха изменяет статус игры.
     * В случае если происходит попытка выйти за пределы поля
     * сдвигает точку внутрь поля на $scareStepsNum и кидает exception
     *
     * @param int $dy
     * @throws ScareException
     */
    private function moveY(int $dy)
    {
        $newPosition = $this->curState->getY() + $dy;
        if ($newPosition >= 0 && $newPosition < $this->boardSize) {
            $this->curState->move(0, $dy);
            $this->status = self::$walkingMessage . ($this->maxStepsNum - $this->stepsNum - 1) .  " шагов";
        } else {
            if ($newPosition < 0) {
                $this->curState->move(0, $this->scareStepsNum);
            } else {
                $this->curState->move(0, -$this->scareStepsNum);
            }
            throw new ScareException();
        }
    }

}