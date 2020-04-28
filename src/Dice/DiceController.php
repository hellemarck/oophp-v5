<?php

namespace Mh\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "index";
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction() : object
    {
        // init the game
        session_destroy();
        $this->app->session->start();
        // $_SESSION["game"] = new Game();
        // same as above but via ramverket instead

        $this->app->session->set("game", new Game());
        $this->app->session->set("histogram", new Histogram());
        $this->app->session->set("diceHistogram", new DiceHistogram());
        return $this->app->response->redirect("dice1/play");
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionGet() : object
    {
        $title = "Tärning 100-spelet";

        $game = $this->app->session->get("game");
        $diceHistogram = $this->app->session->get("diceHistogram");
        $histogram = $this->app->session->get("histogram");

        $data = [
            "game" => $game,
            "histogram" => $histogram,
            "diceHistogram" => $diceHistogram
        ];

        $this->app->page->add("dice1/play", $data);
        // $this->app->page->add("dice/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionPost() : object
    {
        $request = $this->app->request;
        //incoming variable
        // $game = $_SESSION["game"];
        $game = $this->app->session->get("game");
        $diceHistogram = $this->app->session->get("diceHistogram");
        $histogram = $this->app->session->get("histogram");

        /**
         * Handle a players roll,
         * control the game and change players turn
         */

        if ($request->getPost("doRoll")) {
            $game->player->roll();
            // $diceHistogram->roll();
            $histogram->injectData($diceHistogram, $game->player->lastroll());
            // $histogram->updateSerie($game->player->lastroll());
            if ($game->player->roundScore() == 0) {
                $game->changePlayer();
            }
        } elseif ($request->getPost("doSave")) {
            $game->player->save();
            $game->changePlayer();
        } elseif ($request->getPost("cpuRoll")) {
            $res = $game->cpu->cpuRoll($game->player->score());
            foreach ($res as $val) {
                $histogram->injectData($diceHistogram, $val);
            }
            $game->changePlayer();
        }

        return $this->app->response->redirect("dice1/play");
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my dice game";
    }
}
