<h1>Guess game</h1>

<p><b>Instructions:</b> You have <?= $game->tries() ?> guesses on the number I'm looking for, it could be any number between 0 and 100. Go!</p>

<form method="post" action="index-process.php">
    <input type="text" name="guess">
    <input type="hidden" name="number" value="<?= $game->getNumber() ?>">
    <input type="hidden" name="tries" value="<?= $game->tries() ?>">
    <?php if ($game->tries() >= 1 && $game->getNumber() !== (int)$guess) {
        ?>
        <input type="submit" name="doGuess" value="Guess!">
        <input type="submit" name="doCheat" value="Cheat">
    <?php }; ?>
    <input type="submit" name="doInit" value="Reset game">
</form>

<?php if ($game->tries() === 0) { ?>
    <p>YOU LOST.</p>
<?php }; ?>

<?php if ($doGuess) : ?>
    <p>Your guess <?= $guess ?> is <?= $res ?></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>The correct answer is <?= $number ?>.</p>
<?php endif;
