<?php

require __DIR__ . "/config.php";
require __DIR__ . "/autoload.php";

// session_name("mehe19");
session_start();

$guess = $_SESSION["guess"] ?? null;
$doInit = $_SESSION["doInit"] ?? null;
$doGuess = $_SESSION["doGuess"] ?? null;
$doCheat = $_SESSION["doCheat"] ?? null;


if ($doInit || !isset($_SESSION["game"])) {
    session_destroy();
    session_start();
    $_SESSION["game"] = new Guess();
}

$game = $_SESSION["game"];
$_SESSION["tries"] = $game->tries();
$_SESSION["number"] = $game->getNumber();


if ($doGuess) {
    try {
        $res = $game->makeGuess((int)$guess);
        $_SESSION["tries"] = $game->tries();
    } catch (GuessException $e) {
        $res = "not a valid guess, try a number between 1 and 100.";
    }
    $_SESSION["doGuess"] = null;
} elseif ($doCheat) {
    $number = $game->getNumber();
}

// ?><pre><?php
// echo "SESSION\n";
// var_dump($_SESSION);
// ?></pre><?php
//
// ?><pre><?php
// echo "\nGAME\n";
// var_dump($game);
// ?></pre><?php


// render the page w template file

require __DIR__ . "/view/guess.php";
