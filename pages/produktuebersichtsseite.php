<!DOCTYPE html>
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsere Flotte</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleProduktuebersichtsseite.css">
    <title>Unsere Flotte</title>
</head>
 
<body>
<?php
include('../includes/header.html'); // Einbinden des Headers
?>

<form method="post" action= <?php $_SERVER["PHP_SELF"]?>>
    <div class="filterBox">
    <h1> Filter: </h1>
        <div class="itemBox">
            <label for="location">Standort:</label>
                
        </div>
    </div>
    <div class="resultBox">
    <h1> Ergebnisse: </h1>
    </div>
</form>

<?php
include('../includes/footer.html'); // Einbinden des Footers
?>

</body>