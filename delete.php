<?php

include_once 'load.php';
use BaseXClient\BaseXException;
use BaseXClient\Session;

try {

   

    print($id);
    // create session
    $session = new Session("localhost", 1984, "admin", "admin");

    // perform command and print returned string
    $session->execute("OPEN database");
    print $session->info();

    $query = $session->execute("xquery delete node //database/Concours/Concour[@ID_Concours=2]");

    // close session
    $session->close();
    
        
} catch (BaseXException $e) {
    // print exception
    print $e->getMessage();
}

