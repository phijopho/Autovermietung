<html lang="en">
<head>
    <?php
        include('../includes/htmlhead.php')
    ?>
    <link rel="stylesheet" href="css/styleProduktdetailseite.css">
    <title>Produktdetails</title> 
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
        <h2>Ihr ausgewählter Zeitraum: </h2><br> 
        <h2>"Variable Abholdatum" bis "Variable Rückgabedatum"</h2>
        <h2> Standort des Fahrzeugs: "Variable Standort"</h2>
        <h3>Mindestalter: "Variable Alter"</h3>

        <!-- User is Old enough an signed in. -->
        <div class="divbutton">
            <a href="#" class="button">Buchen</a>
        </div>
    </div>
</div>

<?php 
    include('../includes/footer.html'); // Einbindung des Footers
?>

</body>
</html>
 
 