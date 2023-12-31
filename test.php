<?php

include_once 'load.php';
use BaseXClient\BaseXException;
use BaseXClient\Session;

try {
    // create session
    $session = new Session("localhost", 1984, "admin", "admin");

    // perform command and print returned string
    $session->execute("OPEN data");
    print $session->info();

    $query = $session->query("/library/book/year");

    foreach ($query as $resultItem) {
        print $resultItem . "\n";
    }
    // close session
    $session->close();

    // print time needed
} catch (BaseXException $e) {
    // print exception
    print $e->getMessage();
}

