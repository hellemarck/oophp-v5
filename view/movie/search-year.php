<?php require "../view/movie/header.php";?>

<form method="get">
    <fieldset>
    <legend>Search year</legend>
    <input type="hidden" name="route" value="search-year">
    <p>
        <label>Created between:
        <input type="number" name="year1" value="<?= htmlentities($year1) ?: 1900 ?>" min="1900" max="2100" placeholder="1900"/>

        <input type="number" name="year2" value="<?= htmlentities($year2) ?: 2100 ?>" min="1900" max="2100" placeholder="2100"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    <p><a href="show-all">Show all</a></p>


<?php if ($resultset) : ?>
    <table>
        <tr>
            <th>Rad</th>
            <th>Id</th>
            <th>Bild</th>
            <th>Titel</th>
            <th>År</th>
        </tr>
    <?php $id = -1; foreach ($resultset as $row) :
        $id++;?>
        <tr>
            <td><?= htmlentities($id) ?></td>
            <td><?= htmlentities($row->id) ?></td>
            <td><img class="thumb" src="../<?= htmlentities($row->image) ?>"></td>
            <td><?= htmlentities($row->title) ?></td>
            <td><?= htmlentities($row->year) ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif;

?> </fieldset>
</form>
</main>
