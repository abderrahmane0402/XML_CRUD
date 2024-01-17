<?php

include_once '../load.php';
use BaseXClient\BaseXException;
use BaseXClient\Session;

extract($_POST);
extract($_GET);
try {
    $session = new Session("localhost", 1984, "admin", "admin");

    // perform command and print returned string
    $session->execute("OPEN database");

    // update de condidat

    $condidat = '
        <Candidat ID_Candidat="' . $id . '" cin="' . $cin . '" cne="' . $cne . '">
            <Nom>' . $nom . '</Nom>
            <Prenom>' . $prenom . '</Prenom>
            <email>' . $email . '</email>
            <password>' . $password . '</password>
            <telephone>' . $telephone . '</telephone>
            <DateNaissance>' . $date_n . '</DateNaissance>
        </Candidat>';
    $session->execute("xquery replace node //Candidats/Candidat[@ID_Candidat = '" . $id . "'] with" . $condidat);

    // update diplome
    $session->execute("xquery replace value of node //Diplomes/Diplome[@ID_Candidat='$id']/@ID_Specialite with '$specialite'");

    $session->execute("xquery replace value of node //Diplomes/Diplome[@ID_Candidat='$id']/AnneeObtention with '$anne'");

    $choix = '';
    foreach ($concours as $key => $value) {
        if ($key == 0) {
            $choix = $choix . '
                <Choix ID_Candidature="' . $condidature . '" ID_Concours="' . $value . '">
                    <Priorite>' . $key + 1 . '</Priorite>
                </Choix>';
        } else {
            $choix = $choix . ',
                <Choix ID_Candidature="' . $condidature . '" ID_Concours="' . $value . '">
                    <Priorite>' . $key + 1 . '</Priorite>
                </Choix>';
        }
    }

    $session->execute("xquery delete node //Choixs/Choix[@ID_Candidature = '$condidature']");

    print "xquery insert node ($choix) into //Choixs";
    $session->execute("xquery insert node ($choix) into //Choixs");


    $session->close();
    header("Location: http://localhost/php/pages/PageUpdate.php?id=$id");
    exit();


} catch (BaseXException $e) {
    // print exception
    print $e->getMessage();
}