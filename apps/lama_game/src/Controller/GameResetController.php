<?php
/**
 * Created by PhpStorm.
 * User: elama
 * Date: 04.03.19
 * Time: 15:00
 */

namespace App\Controller;

use App\LamaGame\GameBoard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GameResetController extends AbstractController
{

    /**
     * @param SessionInterface $session
     * @return Response
     * @Route("game/lama/reset");
     */
    function resetGame(SessionInterface $session): Response
    {
        if (!$session->has("gameBoard"))
            $session->set('gameBoard', new GameBoard(10));
        $gameBoard = $session->get("gameBoard");
        $gameBoard->prepareToNewGame();
        return $this->redirectToRoute('app_game');
    }


}