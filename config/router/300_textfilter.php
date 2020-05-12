<?php
/**
 * Movie controller
 */
return [
    // Path where to mount the routes, is added to each route path.
    // "mount" => "sample",

    // All routes in order
    "routes" => [
        [
            "info" => "Textfilter controller.",
            "mount" => "textfilter",
            "handler" => "\Mh\TextFilter\TextFilterController",
        ],
    ]
];
