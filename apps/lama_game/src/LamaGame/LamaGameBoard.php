<?php
/**
 * Created by PhpStorm.
 * User: Egor
 * Date: 14.03.2019
 * Time: 20:58
 */

namespace App\LamaGame;

use App\LamaGame\Abstraction\AbstractGameBoard;
use App\LamaGame\Exception\ScareException;

/**
 * Class LamaGameBoard
 *
 * Класс, представляющий доску для игры с ламой.
 *
 * @package App\LamaGame
 */
class LamaGameBoard extends AbstractGameBoard
{
    public function __construct(int $boardSize)
    {
        parent::__construct($boardSize);
        $this->gamePiece = new Lama(0, $this->boardSize-1);
        $this->prepareToNewGame();
    }


    /**
     * Готовит игровую доску к новой игре.
     * Переопределяет метод из суперкласса.
     *
     */
    public function prepareToNewGame()
    {
        parent::prepareToNewGame();
        $this->status = "Я готова к прогулке, пойдем скорее гулять.";
    }

    /**
     * Функция определяет с каким сообщение будет брошено исключение.
     * Определяет абстрактный метод из суперкласса.
     *
     * @return mixed|void
     * @throws ScareException
     */
    protected function raiseScareException()
    {
        throw new ScareException("Я убежала внутрь поля.");
    }

    /**
     * Осуществляет движение ламы по полю.
     * Переопределяет метод из суперкласса.
     *
     * @param int $direction
     * @return string
     */
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