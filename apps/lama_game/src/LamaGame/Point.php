<?php
/**
 * Created by PhpStorm.
 * User: elama
 * Date: 27.02.19
 * Time: 17:52
 */


namespace App\LamaGame;

/**
 * Class Point
 * @package App\LamaGame
 */
class Point
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


    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
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
        $this->y = $n;
    }

}