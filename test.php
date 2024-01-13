
<?php

include_once 'load.php';
use BaseXClient\BaseXException;
use BaseXClient\Session;

try {
    $xmlFilePath = 'C:\xampp\htdocs\XML_CRUD\DataBase.xml';

    if (!file_exists($xmlFilePath)) {
        throw new Exception("XML file not found at: $xmlFilePath");
    }

    $session = new Session("localhost", 1984, "admin", "admin");
    // $session->execute("OPEN DataBase");
    // Perform XQuery and fetch the results
    $session->execute("OPEN database");
    $query = $session->query("for \$candidat in doc('$xmlFilePath')//Candidat return \$candidat");

    // Initialize an empty array to store table rows
    $tableRows = [];

    foreach ($query as $resultItem) {
        // Parse each result as XML
        $candidatXML = simplexml_load_string($resultItem);

        // Extract data from XML
        $idCandidat = $candidatXML['ID_Candidat'];
        $cne = $candidatXML['cne'];
        $cin = $candidatXML['cin'];
        $prenom = $candidatXML->Prenom;
        $nom = $candidatXML->Nom;
        $dateNaissance = $candidatXML->DateNaissance;
        $telephone = $candidatXML->telephone;
        $email = $candidatXML->email;
        $password = $candidatXML->password;

        // Generate a table row and add it to the array
        $tableRows[] = "
            <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                <td class=\"p-4 align-middle [&amp;:has([role=checkbox])]:pr-0\">{$cne}</td>
                <td class=\"p-4 align-middle [&amp;:has([role=checkbox])]:pr-0\">{$cin}</td>
                <td class=\"p-4 align-middle [&amp;:has([role=checkbox])]:pr-0\">{$prenom}</td>
                <td class=\"p-4 align-middle [&amp;:has([role=checkbox])]:pr-0\">{$nom}</td>
                <td class=\"p-4 align-middle [&amp;:has([role=checkbox])]:pr-0\">{$dateNaissance}</td>
                <td class=\"p-4 align-middle [&amp;:has([role=checkbox])]:pr-0\">{$telephone}</td>
                <td class=\"p-4 align-middle [&amp;:has([role=checkbox])]:pr-0\">{$email}</td>
                <td class=\"p-4 align-middle [&amp;:has([role=checkbox])]:pr-0\">{$password}</td>
                <td class=\"p-4 align-middle [&amp;:has([role=checkbox])]:pr-0\">
                    <button class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary/90 h-10 px-4 py-2 bg-green-500 text-white mr-2\">
                        Update
                    </button>
                    <a href=\"../delete.php?id={$idCandidat} \"  class= \"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary/90 h-10 px-4 py-2 bg-red-500 text-white\">
                    Delete
                </a>
                </td>
            </tr>
        ";
    }
    

    // Close session
    $session->close();

    // Output the HTML with dynamic table rows
    echo "
        <div class=\"w-full overflow-x-auto\">
            <div class=\"relative w-full overflow-auto\">
                <table class=\"w-full caption-bottom text-sm\">
                    <thead class=\"[&amp;_tr]:border-b\">
                        <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                            <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0\">
                                CNE
                            </th>
                            <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0\">
                                CIN
                            </th>
                            <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0\">
                                Prénom
                            </th>
                            <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0\">
                                Nom
                            </th>
                            <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0\">
                            Date de Naissance
                        </th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0\">
                            Téléphone
                        </th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0\">
                            Email
                        </th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0\">
                            Mot de passe
                        </th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0\">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class=\"[&amp;_tr:last-child]:border-0\">
                    " . implode("\n", $tableRows) . "
                </tbody>
            </table>
        </div>
    </div>
";

} catch (BaseXException $e) {
// Print exception
print $e->getMessage();
}
?>