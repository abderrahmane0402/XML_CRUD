<?php

include_once 'load.php';
use BaseXClient\BaseXException;
use BaseXClient\Session;

try {
    // create session
    $session = new Session("localhost", 1984, "admin", "admin");

    // perform command and print returned string
    $session->execute("OPEN database");
    print $session->info();

    $query = $session->execute("xquery insert node (<test />) into //Concours");

    print_r($query);
    // close session
    $session->close();

    // print time needed
} catch (BaseXException $e) {
    // print exception
    print $e->getMessage();
}

