<?php

namespace Mh\TextFilter;

use \Michelf\Markdown;

/**
 * Filter and format text content.
 *
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 * @SuppressWarnings(PHPMD.UnusedPrivateField)
 */
class MyTextFilter
{
     /**
      * @var array $filters Supported filters with method names of
      *                     their respective handler.
      */
    private $filters = [
        "bbcode"    => "bbcode2html",
        "link"      => "makeClickable",
        "markdown"  => "markdown",
        "nl2br"     => "nl2br",
    ];



     /**
      * Call each filter on the text and return the processed text.
      *
      * @param string $text   The text to filter.
      * @param array  $filter Array of filters to use.
      *
      * @return string with the formatted text.
      */
    public function parse($text, $filter) // "lite lurig" all fylla i
    {
        if (is_array($filter)) {
            foreach ($filter as $f) { //key
                $filterHandler = $this->filters[$f]; //[$f]
                $text = $this->$filterHandler($text);
            }
        } else {
            $filterHandler = $this->filters[$filter]; //[$f]
            $text = $this->$filterHandler($text);
        }
        return $text;
    }



     /**
      * Helper, BBCode formatting converting to HTML.
      * BBCode = användaren skriver texter, funktionen tar dessa och
      * ersätter med HTML
      *
      * @param string $text The text to be converted.
      *
      * @return string the formatted text.
      */
    public function bbcode2html($text)
    {
        $search = [
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
        ];

        $replace = [
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        ];

        return preg_replace($search, $replace, $text);
    }



     /**
      * Make clickable links from URLs in text.
      * hittar https:, http: och gör om till länkar
      *
      * @param string $text The text that should be formatted.
      *
      * @return string with formatted anchors.
      */
    public function makeClickable($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            function ($matches) {
                return "<a href=\"{$matches[0]}\">{$matches[0]}</a>";
            },
            $text
        );
    }



     /**
      * Format text according to Markdown syntax.
      * gör om \n till <br>
      *
      * @param string $text The text that should be formatted.
      *
      * @return string as the formatted html text.
      */
    public function markdown($text)
    {
        return Markdown::defaultTransform($text);
    }



     /**
      * For convenience access to nl2br formatting of text.
      *
      * @param string $text The text that should be formatted.
      *
      * @return string the formatted text.
      */
    public function nl2br($text)
    {
        $text = str_replace(array("\r\n", "\r", "\n"), "<br />", $text);
        // alt return nl2br($text);
        return $text;
    }
}
