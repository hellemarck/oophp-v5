<?php require "../view/movie/header.php";?>

<form method="get">
    <fieldset>
    <legend>Search</legend>
    <input type="hidden" name="route" value="search-title">
    <p>
        <label>Title (use % as wildcard):
            <input type="text" name="doSearch" placeholder="Search">
        </label>
    </p>
    <p>
        <input type="submit" name="Search" value="Search">
    </p>
    <p><a href="show-all">Show all</a></p>
    </fieldset>
</form>

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
