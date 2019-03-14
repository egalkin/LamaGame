<?php
/**
 * Created by PhpStorm.
 * User: elama
 * Date: 01.03.19
 * Time: 14:44
 */

namespace App\Controller;

use App\LamaGame\LamaGameBoard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GameController extends AbstractController
{

    /**
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     * @Route("game/lama", name="app_game");
     */
    function ruleGame(Request $request, SessionInterface $session): Response
    {
        if (!$session->has("gameBoard"))
            $session->set('gameBoard', new LamaGameBoard(10));
        $gameBoard = $session->get("gameBoard");
        if ($request->isMethod('GET')) {
            return $this->render('game/lama.html.twig', [
                'status' => $gameBoard->getStatus(),
                'finished' => $gameBoard->isfinished(),
            ]);
        } else {
            if ($request->request->has('direction')) {
                $gameBoard->move($request->request->get('direction')[0]);
                return $this->render('game/lama.html.twig', [
                    'status' => $gameBoard->getStatus(),
                    'finished' => $gameBoard->isfinished(),
                ]);
            } else {
                return $this->render('game/lama.html.twig', [
                    'status' => 'Направление движения не было задано, попробуй еще раз',
                    'finished' => $gameBoard->isfinished(),
                ]);
            }
        }

    }
}