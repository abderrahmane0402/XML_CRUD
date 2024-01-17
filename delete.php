<?php

include_once 'load.php';
use BaseXClient\BaseXException;
use BaseXClient\Session;

try {

    $id = $_GET['id'];


    // create session
    $session = new Session("localhost", 1984, "admin", "admin");

    // perform command and print returned string
    $session->execute("OPEN database");


    $query = $session->execute("xquery delete node //Candidats/Candidat[@ID_Candidat=$id]");

    header("Location: http://localhost/php/pages/ListCandidats.php");
    exit();

    // close session
    $session->close();




} catch (BaseXException $e) {
    // print exception
    print $e->getMessage();
}
?>