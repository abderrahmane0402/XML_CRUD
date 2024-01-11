<?php

include_once 'load.php';
use BaseXClient\BaseXException;
use BaseXClient\Session;

try {
    $session = new Session("localhost", 1984, "admin", "admin");

    // perform command and print returned string
    $session->query("let $db := doc('C:/xampp/htdocs/XML_CRUD/DataBase.xml')");
    $query = $session->query("$db//");
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

