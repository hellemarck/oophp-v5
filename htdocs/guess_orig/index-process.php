<?php
include("config.php");
session_start();

$_SESSION["guess"] = $_POST["guess"] ?? null;
$_SESSION["doInit"] = $_POST["doInit"] ?? null;
$_SESSION["doGuess"] = $_POST["doGuess"] ?? null;
$_SESSION["doCheat"] = $_POST["doCheat"] ?? null;

// var_dump($_SESSION);

header('Location: index.php');
