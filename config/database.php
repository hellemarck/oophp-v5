<?php
/**
 * Config file for Database.
 *
 * Example for MySQL.
 *  "dsn" => "mysql:host=localhost;dbname=test;",
 *  "username" => "test",
 *  "password" => "test",
 *  "driver_options"  => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
 *
 * Example for SQLite.
 *  "dsn" => "sqlite:memory::",
 *
 */

if ($_SERVER["SERVER_NAME"] === "www.student.bth.se") {
    return [
        "dsn"             => "mysql:host=blu-ray.student.bth.se;dbname=mehe19;",
        "username"        => "mehe19",
        "password"        => "ciyfAJKa9B4S", //"hemligt"
        "driver_options"  => [
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ],
        "fetch_mode"      => \PDO::FETCH_OBJ,
        "table_prefix"    => null,
        "session_key"     => "Anax\Database",
        "emulate_prepares" => false,

        // True to be very verbose during development
        "verbose"         => false,

        // True to be verbose on connection failed
        "debug_connect"   => true,
    ];
}

return [
    "dsn"             => "mysql:host=127.0.0.1;dbname=oophp;",
    "username"        => "user",
    "password"        => "pass",
    "driver_options"  => [
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
    ],
    "fetch_mode"      => \PDO::FETCH_OBJ,
    "table_prefix"    => null,
    "session_key"     => "Anax\Database",
    "emulate_prepares" => false,

    // True to be very verbose during development
    "verbose"         => false,

    // True to be verbose on connection failed
    "debug_connect"   => true,
];


// INITIAL CODE
// return [
//     "dsn"              => "mysql:host=localhost;dbname=oophp",
//     "username"         => "user",
//     "password"         => "pass",
//     "driver_options"   => [
//         \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
//     ],
//     "fetch_mode"       => \PDO::FETCH_OBJ,
//     "table_prefix"     => null,
//     "session_key"      => "Anax\Database",
//     "emulate_prepares" => false,
//
//     // True to be very verbose during development = felmeddelanden
//     "verbose"         => null,
//
//     // True to be verbose on connection failed - felmedd om inte kan koppla upp till db
//     "debug_connect"   => true,
// ];
