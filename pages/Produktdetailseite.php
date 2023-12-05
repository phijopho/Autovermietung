<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Einbinden der Schriftart -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
    <!-- Einbinden der style.css -->
    <base href="/Autovermietung/">
    <link rel="stylesheet" href="css/style.css">
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
    </div>


</div>

<?php    include('../includes/footer.html'); // Einbindung des Footers
?>

</body>
 
</html>
 
 