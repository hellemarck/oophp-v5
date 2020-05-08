<?php

namespace Anax\View;

/**
 * Template file to render a view with movies.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

if (!$resultset) {
    return;
}

require "../view/movie/header.php";

?>
<fieldset>
<legend>All movies</legend>
<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= htmlentities($id) ?></td>
        <td><?= htmlentities($row->id) ?></td>
        <td><img class="thumb" src="../<?= htmlentities($row->image) ?>"></td>
        <td><?= htmlentities($row->title) ?></td>
        <td><?= htmlentities($row->year) ?></td>
    </tr>
<?php endforeach; ?>
</fieldset>
</table>
</main>
