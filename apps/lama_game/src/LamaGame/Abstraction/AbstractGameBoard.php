<?php
/**
 * Created by PhpStorm.
 * User: elama
 * Date: 27.02.19
 * Time: 17:52
 */

namespace App\LamaGame\Abstraction;

use App\LamaGame\Exception\ScareException;

/**
 * Class AbstractGameBoard
 *
 * Абстрактный класс, представляющий доску для игры.
 *
 * @package App\LamaGame\Abstraction
 */
abstract class AbstractGameBoard
{

    protected static $walkingMessage = "До конца прогулки осталось: ";

    /**
     * Размер доски
     *
     * @var int
     */
    protected $boardSize;

    /**
     * Точка отвечающая за положение фигуры на доске
     *
     * @var AbstractGamePiece
     */
    protected $gamePiece;

    /**
     * Текущий статус игры
     *
     * @var string
     */
    protected $status;

    /**
     * Число пройденный шагов
     *
     * @var int
     */
    protected $stepsNum;

    /**
     * Показывает завершена ли игра или нет.
     *
     * @var bool
     */
    protected $finished;

    /**
     * Число шагов после которых игра завершается
     *
     * @var int
     */
    protected $maxStepsNum;


    /**
     * Число шагов на которое фигура уходи вглубь поля в случае попытки выйти за границу
     * @var int
     */
    protected $scareStepsNum;


    public function __construct(int $boardSize)
    {
        $this->boardSize = $boardSize;
        $this->maxStepsNum = 15;
        $this->scareStepsNum = $this->boardSize / 3;
    }


    /**
     * Готовит внутреннее состояние поля к новой игре.
     *
     */
    public function prepareToNewGame()
    {
        $this->gamePiece->resetToOriginPosition($this->boardSize);
        $this->stepsNum = 0;
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

    public function getPoint(): AbstractGamePiece
    {
        return $this->gamePiece;
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
        try {
            $stepLength = $this->gamePiece->getStepLength();
            switch ($direction) {
                case Direction::North:
                    $this->moveY($stepLength);
                    break;
                case Direction::South:
                    $this->moveY(-$stepLength);
                    break;
                case Direction::West:
                    $this->moveX(-$stepLength);
                    break;
                case Direction::East:
                    $this->moveX($stepLength);
                    break;
            }
        } catch (ScareException $ex) {
            $this->status = $ex->getMessage();
        }
        $this->stepsNum++;
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
        $newPosition = $this->gamePiece->getX() + $dx;
        if ($newPosition >= 0 && $newPosition < $this->boardSize) {
            $this->gamePiece->move($dx, 0);
            $this->status = self::$walkingMessage . ($this->maxStepsNum - $this->stepsNum - 1) . " шагов";
            return;
        } else {
            if ($newPosition < 0) {
                $this->gamePiece->move($this->scareStepsNum, 0);
            } else {
                $this->gamePiece->move(-$this->scareStepsNum, 0);
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
        $newPosition = $this->gamePiece->getY() + $dy;
        if ($newPosition >= 0 && $newPosition < $this->boardSize) {
            $this->gamePiece->move(0, $dy);
            $this->status = self::$walkingMessage . ($this->maxStepsNum - $this->stepsNum - 1) . " шагов";
        } else {
            if ($newPosition < 0) {
                $this->gamePiece->move(0, $this->scareStepsNum);
            } else {
                $this->gamePiece->move(0, -$this->scareStepsNum);
            }
            throw new ScareException();
        }
    }

}