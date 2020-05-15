<?php
$textFilter = new Mh\TextFilter\MyTextFilter();

$filter = $content->filter;
$data = $content->data;
$filter_array = explode(',', $filter);
?>
<article>
    <header>
        <p><a href="/~mehe19/dbwebb-kurser/oophp/me/redovisa/htdocs/cms/pages" class="goback-link">< Back to view</a></p>
        <h1><?= esc($content->title) ?></h1>
        <p><i>Latest update: <time datetime="<?= esc($content->modified_iso8601) ?>" pubdate><?= esc($content->modified) ?></time></i></p>
    </header>
    <?= $textFilter->parse($data, $filter_array) ?>
</article>
</main>
</body>
</html>
