<html lang="en">
<head>
    <?php
        include('../includes/htmlhead.php')
    ?>
    <link rel="stylesheet" href="css/styleProduktdetailseite.css">
    <script src="includes/funktions.js"></script> 
    <title>Produktdetails</title> 
</head>
<header>
<?php
    include('../includes/header.html'); // Einbindung des Headers
?>
</header> 

<body>

<div class="divbody">
    <div class="divgallery">
        <h1>"Fahrzeugmodell"</h1>
        <div class="foto">
  
            <img src="images/Default_Car_Cabrio_from_mercedes_no_car_brand_visible_silver_n_0_3ab7f2a6-a473-48dc-ba48-421b05e7453f_0.png" alt="Auto">
            <button class="buttonToggle" onclick="togglemenu()">&#9660;</button>
            <div class="desc" id="desc">
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
        <div class="divText">
            <h2> Zusammenfassung </h2><br>
            <h3>Ihr ausgewählter Zeitraum: </h3>
            <p>"Variable Abholdatum" bis "Variable Rückgabedatum"</p>
            <h3> Standort des Fahrzeugs: </h3> <p> "Variable Standort"</p>
            <h3>Mindestalter: </h3><p> "Variable Alter"</p>
        </div>
        <!-- User is Old enough an signed in. -->
        <div class="divbutton">
            <a href="#" class="button">Buchen</a>
        </div>
    </div>
</div>

</body>

<footer>
<?php 
    include('../includes/footer.html'); // Einbindung des Footers
?>
</footer>
</html>
 
 
