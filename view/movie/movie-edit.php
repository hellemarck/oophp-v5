<?php

namespace Anax\View;
require "../view/movie/header.php";
?>
<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="movieId" value="<?= $movie[0]->id ?>"/>

    <p>
        <label>Title:<br>
        <input type="text" name="movieTitle" value="<?= $movie[0]->title ?>"/>
        </label>
    </p>

    <p>
        <label>Year:<br>
        <input type="number" name="movieYear" value="<?= $movie[0]->year ?>"/>
    </p>

    <p>
        <label>Image:<br>
        <input type="text" name="movieImage" value="<?= $movie[0]->image ?>"/>
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save" formaction="saveChanges">
        <input type="reset" value="Reset">
    </p>
    <p>
        <a href="movie-select">Select movie</a> |
        <a href="show-all">Show all</a>
    </p>
    </fieldset>
</form>
