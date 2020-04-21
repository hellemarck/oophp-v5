<?php

/**
 * Init the dice game w session and game object
 */

$app->router->get("dice/init", function () use ($app) {
    // init the game
    session_destroy();
    $app->session->start();
    $_SESSION["game"] = new Mh\Dice\Game();
    return $app->response->redirect("dice/play");
});



/**
 * Play the dice game, show game status and debug
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Tärning 100-spelet";

    $game = $_SESSION["game"];

    $data = [
        "game" => $game
    ];

    $app->page->add("dice/play", $data);
    // $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the dice game, roll the dice
 */
$app->router->post("dice/play", function () use ($app) {

    //incoming variable
    $game = $_SESSION["game"];
    /**
     * Handle a players roll,
     * control the game and change players turn
     */

    if ($_POST["doRoll"]) {
        $game->player->roll();
        if ($game->player->roundScore() == 0) {
            $game->changePlayer();
        }
    } elseif ($_POST["doSave"]) {
        $game->player->save();
        $game->changePlayer();
    } elseif ($_POST["cpuRoll"]) {
        $res = $game->cpu->cpuRoll();
        $game->changePlayer();
    }

    return $app->response->redirect("dice/play");
});
