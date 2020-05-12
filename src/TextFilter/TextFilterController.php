<?php

namespace Mh\TextFilter;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * Controller for Textfilter methods
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class TextFilterController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * route to edit movie
     */
    public function indexActionGet() : object
    {
        $title = "Textfilter | oophp";
        $testString = "[b]This is[/b] [i]a test[/i]";
        $testLink = "https://google.com";
        $testMd = "###this is a **h3**";
        $testNl2br = "Here comes\na line break";
        $testReadFromMd = file_get_contents(__DIR__ . "/../../view//textfilter/sample.md");
        $testImg = "[img]https://cdn3.cdnme.se/267467/9-3/mobiluppladdning_5e21a9fa2a6b224a2cfd54a2.jpg[/img]";
        $multiTest = "[i]Hej![/i] Nu blir det [u]svenska[/u] mitt i all **engelska**. jag har nyss ätit frukost och snart blir det lunch, du kan läsa om frukost här https://sv.wikipedia.org/wiki/Frukost och [här](https://www.svt.se/) kan du läsa nyheter samtidigt \nhoppsan där kom ett radbryt. Eller? Här är en bild på en _hare_ [img]https://www.svenskveterinartidning.se/wp-content/uploads/2019/09/AdobeStock_100230347.jpeg[/img] eller?";

        $filter = new MyTextFilter();

        $data = [
            "yep its work", "hallojj",
            "testStringPre" => $testString,
            "testStringPost" => $filter->parse($testString, "bbcode"),
            "testLinkPre" => $testLink,
            "testLinkPost" => $filter->parse($testLink, "link"),
            "testMdPre" => $testMd,
            "testMdPost" => $filter->parse($testMd, "markdown"),
            "testNl2brPre" => $testNl2br,
            "testNl2brPost" => $filter->parse($testNl2br, "nl2br"),
            "multiTestPre" => $multiTest,
            "multiTestPost" => $filter->parse($multiTest, ["bbcode", "link", "markdown", "nl2br"]),
            "testImgPre" => $testImg,
            "testImgPost" => $filter->parse($testImg, "bbcode"),
            "testReadFromMdPre" => $testReadFromMd,
            "testReadFromMdPost" => $filter->parse($testReadFromMd, "markdown")
        ];

        $this->app->page->add("textfilter/show-all", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
