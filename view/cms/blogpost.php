<?php
$textFilter = new Mh\TextFilter\MyTextFilter();

$filter = $content->filter;
$data = $content->data;
$filter_array = explode(',', $filter);

?>

<article>
    <header>
        <p><a href="/~mehe19/dbwebb-kurser/oophp/me/redovisa/htdocs/cms/blog" class="goback-link">< Back to view</a></p>

        <h2><?= esc($content->title) ?></h2>
        <p><i>Published: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i></p>
    </header>
    <?= $textFilter->parse($data, $filter_array) ?>
</article>
</main>
</body>
</html>
