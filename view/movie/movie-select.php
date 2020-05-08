<?php

namespace Anax\View;

require "../view/movie/header.php";?>

<form method="post">
    <fieldset>
    <legend>Create, edit or delete a movie</legend>

    <input type="submit" name="doAdd" value="Add new movie" formaction="addMovie">


    <p>
        <label>Edit or delete existing movie:<br>
        <select name="movieId">
            <option value="">Select movie</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <!-- <a href="movie-add">Add</a> -->
        <!-- <input type="submit" name="doAdd" value="Add" formaction="movie-add"> -->
        <input type="submit" name="doEdit" value="Edit" formaction="editMovie">
        <input type="submit" name="doDelete" value="Delete" formaction="deleteMovie">
    </p>
    <p><a href="show-all">Show all</a></p>
    </fieldset>
</form>
</main>
