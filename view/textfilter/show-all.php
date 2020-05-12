<?php
namespace Anax\View;

?>

<h2>View changes with textfilters</h1>
<!-- <?php var_dump($data); ?> -->

<h3>Testing BBCode converting to HTML</h3>
<h5>Before</h5>
<?= $testStringPre ?>
<h5>After</h5>
<?= $testStringPost ?>


<h3>Testing image (BBCode)</h3>
<h5>Before</h5>
<?= $testImgPre ?>
<h5>After</h5>
<?= $testImgPost ?>


<h3>Testing links made clickable</h3>
<h5>Before</h5>
<?= $testLinkPre ?>
<h5>After</h5>
<?= $testLinkPost ?>


<h3>Testing Markdown conversion</h3>
<h5>Before</h5>
<?= $testMdPre ?>
<h5>After</h5>
<?= $testMdPost ?>


<h3>Testing linebreaks (nl2br)</h3>
<h5>Before</h5>
<?= $testNl2brPre ?>
<h5>After</h5>
<?= $testNl2brPost ?>


<h3>Testing multiple conversions</h3>
<h5>Before</h5>
<?= $multiTestPre ?>
<h5>After</h5>
<?= $multiTestPost ?>


<h3>Read from Mardown-file and convert</h3>
<h5>Before</h5>
<?= $testReadFromMdPre ?>
<h5>After</h5>
<?= $testReadFromMdPost ?>
