<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$game = $_SESSION["game"];
$player = $_SESSION["game"]->player;
$cpu = $_SESSION["game"]->cpu;
$winner = $game->winner($player->score(), $cpu->score()) ?? false;


?><h1>Tärningsspelet 100</h1>

<p><b>Instruktioner:</b></p>
<p>Spelet går ut på att du kastar en tärning så många gånger du vill.
Du får lägga ihop poängen fram tills att du slår en etta, då förlorar du
poängen för den omgången. Du kan välja att stanna när du vill och spara dina poäng
inför nästa runda, eller att chansa på att slå igen och hoppas på att du inte
slår en etta. Du spelar mot datorn. Kör igång!</p>

<div class="scoreboard">
<p>Din totalpoäng: <?php echo $player->score() ?></p>
<p>Din poäng denna omgång: <?php echo $player->roundScore() ?></p>
<p>Ditt senaste slag: <?php echo $player->lastRoll() ?></p>
<p>Datorns totalpoäng: <?php echo $cpu->score() ?></p>
<p>Datorns senaste poäng: <?php echo $cpu->lastRoll() ?></p>
</div>


<?php if ($winner && $winner[1] == "player") {
    ?><p style="font-size:27">DU VANN!!!!!</p> <?php
} elseif ($winner && $winner[1] == "cpu") {
    ?><p style="font-size:27">DATORN VANN.... </p><?php
} elseif ($game->turn == "player") {
    ?><p><b>Det är din tur!</b></p>
    <form method="post">
        <input type="submit" name="doRoll" value="Slå tärningen">
        <input type="submit" name="doSave" value="Spara poäng">
    </form><?php
} elseif ($game->turn == "cpu") {
    ?><p><b>Det är datorns tur.</b></p>
    <form method="post">
        <input type="submit" name="cpuRoll" value="Låt datorn spela."><?php
}
?>


<a href="init" class="restart-btn">Börja om</a>
