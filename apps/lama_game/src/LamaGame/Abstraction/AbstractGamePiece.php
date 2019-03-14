<?php
/**
 * Created by PhpStorm.
 * User: elama
 * Date: 27.02.19
 * Time: 17:52
 */


namespace App\LamaGame;

/**
 * Class AbstractGamePiece
 * @package App\LamaGame
 */
abstract class AbstractGamePiece
{

    /**
     * Значение координат по оси X
     *
     * @var int
     */
    private $x;

    /**
     * Значение координат по оси Y
     *
     * @var int
     */
    private $y;

    /**
     * Число шагов на которое ходит игровая фишка за один ход.
     *
     * @var int
     */
    private $stepLength;


    public function __construct(int $x, int $y, int $stepLength)
    {
        $this->x = $x;
        $this->y = $y;
        $this->stepLength = $stepLength;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getStepLength(): int
    {
        return $this->stepLength;
    }


    public function __toString()
    {
        return "$this->x $this->y";
    }

    /**
     * Эта функция изменяет координаты точки по оси X и Y
     * в зависимости от заданных преращений координат
     *
     * @param int $dx
     * @param int $dy
     */
    public function move(int $dx, int $dy)
    {
        $this->x += $dx;
        $this->y += $dy;
    }


    /**
     * В контексте использования в игре эта функция
     * возвращает точку в исходное положение, в зависимости
     * от размера игровой доски
     *
     * @param int $n
     */
    public function resetToOriginPosition(int $n)
    {
        $this->x = 0;
        $this->y = $n - 1;
    }

}