<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include('includes/htmlhead.php')
        ?>
        <!-- Einbinden der style.css -->
        <link rel="stylesheet" href="css/styleHomepage.css">
        <title>SWIFT rentals</title>

    </head>

    <?php
    include('includes/header.html'); // include header
    ?>

    <body>

        <?php

            include('includes/dbConnection.php'); // connect database

            include('pages/homepage.php'); // include body content

        ?> 

    </body>

<?php
    include('includes/footer.html'); // include footers
?>

</html>
