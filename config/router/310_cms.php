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
            "info" => "CMS.",
            "mount" => "cms",
            "handler" => "\Mh\Cms\CmsController",
        ],
    ]
];
