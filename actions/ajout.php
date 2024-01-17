<?php

include_once '../load.php';
use BaseXClient\BaseXException;
use BaseXClient\Session;

extract($_POST);
try {
    $session = new Session("localhost", 1984, "admin", "admin");

    // perform command and print returned string
    $session->execute("OPEN database");

    // insertion de condidat
    $query = $session->query("string(//Candidats/Candidat[last()]/@ID_Candidat)");
    foreach ($query as $key => $value) {
        $id_condidat = intval($value) + 1;
    }

    $condidat = '
        <Candidat ID_Candidat="' . $id_condidat . '" cin="' . $cin . '" cne="' . $cne . '">
            <Nom>' . $nom . '</Nom>
            <Prenom>' . $prenom . '</Prenom>
            <email>' . $email . '</email>
            <password>' . $password . '</password>
            <telephone>' . $telephone . '</telephone>
            <DateNaissance>' . $date_n . '</DateNaissance>
        </Candidat>';
    $query = $session->execute("xquery insert node (" . $condidat . ") into //Candidats");

    // insertion de diplome
    $query = $session->query("string(//Diplomes/Diplome[last()]/@ID_Diplome)");
    foreach ($query as $key => $value) {
        $id_diplome = intval($value) + 1;
    }
    $diplome = '
    <Diplome ID_Diplome="' . $id_diplome . '" ID_Condidat="' . $id_condidat . '" ID_Specialite="' . $specialite . '">
        <AnneeObtention>' . $anne . '</AnneeObtention>
    </Diplome>';

    $query = $session->execute("xquery insert node (" . $diplome . ") into //Diplomes");

    // insertion de condidature
    $query = $session->query("string(//Candidatures/Candidature[last()]/@ID_Candidature)");
    foreach ($query as $key => $value) {
        $id_condidature = intval($value) + 1;
    }
    $condidature = '
    <Candidature ID_Candidature="' . $id_condidature . '" ID_Candidat="' . $id_condidat . '">
           <Date_Candidature>' . date("Y-m-d") . '</Date_Candidature>
        </Candidature>';

    $query = $session->execute("xquery insert node (" . $condidature . ") into //Candidatures");

    $i = 0;
    foreach ($concours as $key => $value) {
        $i += 1;
        $choix = '
        <Choix ID_Candidature="' . $id_condidature . '" ID_Concours="' . $value . '">
            <Priorite>' . $i . '</Priorite>
        </Choix>';
        $query = $session->execute("xquery insert node (" . $choix . ") into //Choixs");
    }


    $session->close();

    header("Location: http://localhost/php/pages/ListCandidats.php");
    exit();

} catch (BaseXException $e) {
    // print exception
    print $e->getMessage();
}