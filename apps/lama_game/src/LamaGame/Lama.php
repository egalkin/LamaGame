<?php
/**
 * Created by PhpStorm.
 * User: Egor
 * Date: 14.03.2019
 * Time: 20:51
 */

namespace App\LamaGame;

use App\LamaGame\Abstraction\AbstractGamePiece;


/**
 * Class Lama
 *
 * Класс, представляющий фишку ламы на игровой доске.
 *
 * @package App\LamaGame
 */
class Lama extends AbstractGamePiece
{

    /**
     *
     * Расстояние на которое ходит лама за один ход
     *
     * @var int
     */
    private static $lamaStepLength = 1;

    public function __construct(int $x, int $y)
    {
        parent::__construct($x, $y, self::$lamaStepLength);
    }

}