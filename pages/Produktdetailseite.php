<html lang="en">
<head>
    <?php
        include('../includes/htmlhead.php')
    ?>

    <link rel="stylesheet" href="css/styleProduktdetailseite.css">
    <title>Unsere Flotte</title> 
</head>
 
<body>
<?php
include('../includes/header.html'); // Einbindung des Headers
?>

<div class="divbody">
    <div class="divgallery">
        <h1>"Fahrzeugmodell"</h1>
        <div class="foto">
  
        <img src="images/cabrio-mercedes-benz-2845333_1920.png" alt="Auto">
            <div class="desc">
                <table>
                    <tr>
                        <th>Fahrzeugtyp</th>
                        <td>"Variable"</td>
                        <th>Getriebe</th>
                        <td>"Variable"</td>
                    </tr>
                    <tr>
                        <th>Anzahl Sitze</th>
                        <td>"Variable"</td>
                        <th>GPS</th>
                        <td>"Variable"</td>
                    </tr>
                    <tr>
                        <th>Anzahl Türen</th> 
                        <td>"Variable"</td>
                        <th>Klimaanlage</th>
                        <td>"Variable"</td>    
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="divinfo">
        <h2>Ihr ausgewählter Zeitraum: </h2> <br> 
            <h2>"Variable Abholdatum" bis "Variable Rückgabedatum" </h2>
                <h2> Standort des Fahrzeugs: "Variable Standort"</h2>
                    <h3>Mindestalter: "Variable Alter"</h3>

                    <!-- User is Old enough an signed in. -->
                        <div class="divbutton">
                            <a href="#" class="button">Buchen</a>
                        </div>

                    <!-- If User is not Old enough Errormessage appears -->

                    <!-- <div class="divbutton">
                        <a href="#" class="buttonNotOldEnough">Buchen</a>
                    </div> -->

                    <!-- If User not signed in, link to login page -->

                    <!-- <div class="divbutton">
                        <a href="#" class="buttonNotSignedIn">Bitte Anmelden</a>
                    </div> -->

                   
<!-- // Annahme: Hier wird überprüft, ob der Benutzer angemeldet ist
// $angemeldet = /* Hier wird geprüft, ob der Benutzer angemeldet ist, z.B. durch eine Session-Variable oder ähnliches */;

// Annahme: Hier wird das Alter des Benutzers abhängig vom Fahrzeugmodell überprüft
// Dummy-Daten: Hier wird angenommen, dass das Mindestalter für verschiedene Fahrzeugmodelle gespeichert ist
// $mindestalterFahrzeug = [

//     'ModellA' => 21, // Mindestalter für ModellA ist 21 Jahre
//     'ModellB' => 18, // Mindestalter für ModellB ist 18 Jahre
//     'ModellC' => 25, // Mindestalter für ModellB ist 18 Jahre
// ];

// $benutzerAlter = /* Hier wird das tatsächliche Alter des Benutzers abgerufen, z.B. aus der Datenbank */;

// $fahrzeugModellDesBenutzers = /* Hier wird das Fahrzeugmodell des Benutzers abgerufen, z.B. aus der Datenbank */;

// Überprüfen, ob der Benutzer angemeldet ist und das Mindestalter erreicht hat
// if ($angemeldet && isset($mindestalterFahrzeug[$fahrzeugModellDesBenutzers]) && $benutzerAlter >= $mindestalterFahrzeug[$fahrzeugModellDesBenutzers]) {
    // Wenn der Benutzer angemeldet ist und das Mindestalter erreicht hat, zeige den "Buchen"-Button an
//     echo '
//     <div class="divbutton">
//         <a href="#" class="button">Buchen</a>
//     </div>';
// } elseif (!$angemeldet) {
    // Wenn der Benutzer nicht angemeldet ist, zeige einen Link zur Anmeldeseite
//     echo '
//     <div class="divbutton">
//         <a href="login.php" class="buttonNotSignedIn">Bitte anmelden</a>
//     </div>';
// } else {
    // Wenn der Benutzer angemeldet ist, aber nicht das erforderliche Alter hat, zeige eine Fehlermeldung an
//     echo '
//     <div class="divbutton">
//         <p>Du bist nicht alt genug, um fortzufahren.</p>
//     </div>';
// }
// //  -->
    </div>


</div>

<?php include('../includes/footer.html'); // Einbindung des Footers
?>
</body>
</html>
 
 