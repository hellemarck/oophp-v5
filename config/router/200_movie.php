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
            "info" => "Movie controller.",
            "mount" => "movie",
            "handler" => "\Mh\Movie\MovieController",
        ],
    ]
];
