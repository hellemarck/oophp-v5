<?php
namespace Anax\View;

require "../view/movie/header.php";?>

<h3>Add movie</h3>

<form action="post">
    <label for="title" value>Title:</label><br>
    <input type="text" name="title" placeholder="Title">
    <br><br>

    <label for="img">Image:</label><br>
    <input type="text" name="img" value="img/noimage.png">
    <br><br>

    <label for="year">Year:</label><br>
    <input type="text" name="year" placeholder="Year">
    <br><br>

    <input type="submit" name="doAdd" value="Add movie" formaction="saveNewMovie">
</form>
</main>
