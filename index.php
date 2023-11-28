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
    <body>

        <?php

            include('includes/dbConnection.php'); // connect database

            include('includes/header.html'); // include header

            include('pages/homepage.php'); // include body content

            include('includes/footer.html'); // include footers

        ?> 

    </body>
</html>
