<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Init the game, redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init the game
    $_SESSION["game"] = new Mh\Guess\Guess();
    return $app->response->redirect("guess/play");
});



/**
 * Play the guess game, show game status
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    $game = $_SESSION["game"];
    $_SESSION["tries"] = $game->tries();
    $_SESSION["number"] = $game->getNumber();

    $tries = $_SESSION["tries"] ?? null;
    $number = $_SESSION["number"] ?? null;

    $guess = $_SESSION["guess"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;
    $number = $_SESSION["number"] ?? null;

    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;

    $data = [
        "guess" => $guess ?? null,
        "res" => $res,
        "game" => $game,
        "doGuess" => $doGuess ?? null,
        "number" => $number ?? null,
        "doCheat" => $doCheat ?? null,
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the guess game, make a guess
 */
$app->router->post("guess/play", function () use ($app) {

    //incoming variables
    $game = $_SESSION["game"];
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;
    $_SESSION["doCheat"] = $doCheat;
    $res = null;

    /**
     * Handle a players guess with exception,
     * also cheat and init possibilities
     */

    if ($doGuess) {
        $_SESSION["tries"] = $game->tries();
        $_SESSION["guess"] = $guess;
        try {
            $res = $game->makeGuess((int)$guess);
            $tries = $game->tries();
        } catch (Mh\Guess\GuessException $e) {
            $res = "not a valid guess, try a number between 1 and 100.";
        }
        $_SESSION["doGuess"] = null;
        $_SESSION["res"] = $res;
    } elseif ($doCheat) {
        $number = $game->getNumber();
    } elseif ($doInit) {
        session_destroy();
        session_start();
        $_SESSION["game"] = new Mh\Guess\Guess();
    }

    return $app->response->redirect("guess/play");
});
