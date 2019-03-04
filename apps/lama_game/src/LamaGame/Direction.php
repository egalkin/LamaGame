<?php
/**
 * Created by PhpStorm.
 * User: elama
 * Date: 27.02.19
 * Time: 18:32
 */

namespace App\LamaGame;


/**
 * Enum класс, представляющий направление движения,
 *
 * Class Direction
 * @package App\LamaGame
 */
class Direction
{
    const __default = self::North;

    const North = 1;
    const South = 2;
    const West = 3;
    const East = 4;
}